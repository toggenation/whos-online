<?php

declare(strict_types=1);

namespace WhosOnline\Middleware;

use App\Lib\Utility\Traits\ErrorFormatterTrait;
use Cake\Chronos\Chronos;
use Cake\Core\Configure;
use Cake\Http\Cookie\Cookie;
use Cake\Log\LogTrait;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use Cake\Routing\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use WhosOnline\Model\Table\WhosOnlineTable;

/**
 * WhosOnline middleware
 */
class WhosOnlineMiddleware implements MiddlewareInterface
{
    use LogTrait;
    use LocatorAwareTrait;
    use ErrorFormatterTrait;

    private Table $table;

    public function __construct()
    {
        $this->table = $this->fetchTable('WhosOnline.WhosOnline');
    }
    /**
     * Process method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->update($request);

        $this->deleteOld();

        return $handler->handle($request);
    }

    private function getData($request)
    {
        $request->setTrustedProxies(Configure::read('TRUSTED_PROXIES'));

        $ip = $request->clientIp();
        $agent = $request->getEnv('HTTP_USER_AGENT');
        $hash = hash('md5', $ip . $agent);

        return [
            'ip_agent_hash' => $hash,
            'ip' => $ip,
            'user_agent' => $agent,
            'user_id' => $request->getAttribute('identity')?->getIdentifier(),
            'url' => Router::url(null, true),
            'php_session_id' => $request->getCookie(Configure::read('Session.cookie')),
        ];
    }

    private function update($request)
    {
        /**
         * @var \Cake\Http\ServerRequest $request
         */

        $data = $this->getData($request);

        if ($this->isLogout($request->getAttributes()['params'])) {
            $this->deleteByHash($data['ip_agent_hash']);
            return;
        }

        $conditions = [
            'ip_agent_hash' => $data['ip_agent_hash']
        ];

        if ($this->table->exists($conditions)) {
            $entity = $this->table->find('all')
                ->where($conditions)->first();

            $entity = $this->table->patchEntity($entity, $data + [
                'modified' => Chronos::now()
            ]);
        } else {
            $entity = $this->table->newEntity($data);
        }

        if ('DebugKit' !== $request->getParam('plugin') && PHP_SAPI !== 'cli') {
            if ($this->table->save($entity) === false) {
                $request->getFlash()->set("Failed to save Whos Online information", ['element' => 'error']);
            };
        };
    }

    private function isLogout(array $params): bool
    {
        return null === $params['plugin'] &&
            'users' === strtolower($params['controller']) &&
            'logout' === strtolower($params['action']);
    }

    private function deleteByHash($hash)
    {
        $this->delete(['ip_agent_hash' => $hash]);
    }

    private function deleteOld()
    {
        $this->delete([
            'created <' => Chronos::now()->subMinutes(Configure::read('Session.timeout'))
        ]);
    }

    private function delete($conditions)
    {
        $this->table->deleteAll($conditions);
    }
}
