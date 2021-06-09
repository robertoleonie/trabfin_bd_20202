<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TbQuestiontype Controller
 *
 * @property \App\Model\Table\TbQuestiontypeTable $TbQuestiontype
 * @method \App\Model\Entity\TbQuestiontype[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbQuestiontypeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tbQuestiontype = $this->paginate($this->TbQuestiontype);

        $this->set(compact('tbQuestiontype'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Questiontype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbQuestiontype = $this->TbQuestiontype->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tbQuestiontype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbQuestiontype = $this->TbQuestiontype->newEmptyEntity();
        if ($this->request->is('post')) {
            $tbQuestiontype = $this->TbQuestiontype->patchEntity($tbQuestiontype, $this->request->getData());
            if ($this->TbQuestiontype->save($tbQuestiontype)) {
                $this->Flash->success(__('The tb questiontype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb questiontype could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestiontype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Questiontype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbQuestiontype = $this->TbQuestiontype->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbQuestiontype = $this->TbQuestiontype->patchEntity($tbQuestiontype, $this->request->getData());
            if ($this->TbQuestiontype->save($tbQuestiontype)) {
                $this->Flash->success(__('The tb questiontype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb questiontype could not be saved. Please, try again.'));
        }
        $this->set(compact('tbQuestiontype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Questiontype id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbQuestiontype = $this->TbQuestiontype->get($id);
        if ($this->TbQuestiontype->delete($tbQuestiontype)) {
            $this->Flash->success(__('The tb questiontype has been deleted.'));
        } else {
            $this->Flash->error(__('The tb questiontype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
