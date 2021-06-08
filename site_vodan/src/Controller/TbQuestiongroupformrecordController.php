<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TbQuestiongroupformrecord Controller
 *
 * @property \App\Model\Table\TbQuestiongroupformrecordTable $TbQuestiongroupformrecord
 * @method \App\Model\Entity\TbQuestiongroupformrecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbQuestiongroupformrecordController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tbQuestiongroupformrecord = $this->paginate($this->TbQuestiongroupformrecord);

        $this->set(compact('tbQuestiongroupformrecord'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Questiongroupformrecord id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbQuestiongroupformrecord = $this->TbQuestiongroupformrecord->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tbQuestiongroupformrecord'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbQuestiongroupformrecord = $this->TbQuestiongroupformrecord->newEmptyEntity();
        if ($this->request->is('post')) {
            $tbQuestiongroupformrecord = $this->TbQuestiongroupformrecord->patchEntity($tbQuestiongroupformrecord, $this->request->getData());
            if ($this->TbQuestiongroupformrecord->save($tbQuestiongroupformrecord)) {
                $this->Flash->success(__('The tb questiongroupformrecord has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb questiongroupformrecord could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestiongroupformrecord'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Questiongroupformrecord id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbQuestiongroupformrecord = $this->TbQuestiongroupformrecord->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbQuestiongroupformrecord = $this->TbQuestiongroupformrecord->patchEntity($tbQuestiongroupformrecord, $this->request->getData());
            if ($this->TbQuestiongroupformrecord->save($tbQuestiongroupformrecord)) {
                $this->Flash->success(__('The tb questiongroupformrecord has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb questiongroupformrecord could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestiongroupformrecord'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Questiongroupformrecord id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbQuestiongroupformrecord = $this->TbQuestiongroupformrecord->get($id);
        if ($this->TbQuestiongroupformrecord->delete($tbQuestiongroupformrecord)) {
            $this->Flash->success(__('The tb questiongroupformrecord has been deleted.'));
        } else {
            $this->Flash->error(__('The tb questiongroupformrecord could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
