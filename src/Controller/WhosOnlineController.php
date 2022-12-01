<?php

declare(strict_types=1);

namespace WhosOnline\Controller;

use WhosOnline\Controller\AppController;

/**
 * WhosOnline Controller
 *
 * @property \WhosOnline\Model\Table\WhosOnlineTable $WhosOnline
 * @method \WhosOnline\Model\Entity\WhosOnline[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WhosOnlineController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $this->paginate = [
            'order' => [
                'WhosOnline.modified' => 'DESC',
                'WhosOnline.created' => 'DESC'
            ]
        ];

        $whosOnline = $this->WhosOnline->find()->contain(['Users']);

        $whosOnline = $this->paginate($whosOnline);

        $this->set(compact('whosOnline'));
    }

    /**
     * View method
     *
     * @param string|null $id Whos Online id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $whosOnline = $this->WhosOnline->get($id, [
            'contain' => 'Users'
        ]);

        $this->set(compact('whosOnline'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Whos Online id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $whosOnline = $this->WhosOnline->get($id);
        if ($this->WhosOnline->delete($whosOnline)) {
            $this->Flash->success(__('The whos online has been deleted.'));
        } else {
            $this->Flash->error(__('The whos online could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
