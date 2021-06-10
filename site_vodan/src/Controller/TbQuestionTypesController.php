<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbQuestionTypes Controller
 *
 * @property \App\Model\Table\TbQuestionTypesTable $TbQuestionTypes
 *
 * @method \App\Model\Entity\TbQuestionType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbQuestionTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tbQuestionTypes = $this->paginate($this->TbQuestionTypes);

        $this->set(compact('tbQuestionTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Question Type id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbQuestionType = $this->TbQuestionTypes->get($id, [
            'contain' => [],
        ]);

        $this->set('tbQuestionType', $tbQuestionType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbQuestionType = $this->TbQuestionTypes->newEntity();
        if ($this->request->is('post')) {
            $tbQuestionType = $this->TbQuestionTypes->patchEntity($tbQuestionType, $this->request->getData());
            if ($this->TbQuestionTypes->save($tbQuestionType)) {
                $this->Flash->success(__('The tb question type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question type could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestionType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Question Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbQuestionType = $this->TbQuestionTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbQuestionType = $this->TbQuestionTypes->patchEntity($tbQuestionType, $this->request->getData());
            if ($this->TbQuestionTypes->save($tbQuestionType)) {
                $this->Flash->success(__('The tb question type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb question type could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestionType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Question Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbQuestionType = $this->TbQuestionTypes->get($id);
        if ($this->TbQuestionTypes->delete($tbQuestionType)) {
            $this->Flash->success(__('The tb question type has been deleted.'));
        } else {
            $this->Flash->error(__('The tb question type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
