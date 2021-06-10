<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbQuestionGroups Controller
 *
 * @property \App\Model\Table\TbQuestionGroupsTable $TbQuestionGroups
 *
 * @method \App\Model\Entity\TbQuestionGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbQuestionGroupsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tbQuestionGroups = $this->paginate($this->TbQuestionGroups);

        $this->set(compact('tbQuestionGroups'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Question Group id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbQuestionGroup = $this->TbQuestionGroups->get($id, [
            'contain' => [],
        ]);

        $this->set('tbQuestionGroup', $tbQuestionGroup);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbQuestionGroup = $this->TbQuestionGroups->newEntity();
        if ($this->request->is('post')) {
            $tbQuestionGroup = $this->TbQuestionGroups->patchEntity($tbQuestionGroup, $this->request->getData());
            if ($this->TbQuestionGroups->save($tbQuestionGroup)) {
                $this->Flash->success(__('The tb question group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question group could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestionGroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Question Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbQuestionGroup = $this->TbQuestionGroups->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbQuestionGroup = $this->TbQuestionGroups->patchEntity($tbQuestionGroup, $this->request->getData());
            if ($this->TbQuestionGroups->save($tbQuestionGroup)) {
                $this->Flash->success(__('The tb question group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question group could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestionGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Question Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbQuestionGroup = $this->TbQuestionGroups->get($id);
        if ($this->TbQuestionGroups->delete($tbQuestionGroup)) {
            $this->Flash->success(__('The tb question group has been deleted.'));
        } else {
            $this->Flash->error(__('The tb question group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
