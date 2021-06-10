<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbHospitalUnits Controller
 *
 * @property \App\Model\Table\TbHospitalUnitsTable $TbHospitalUnits
 *
 * @method \App\Model\Entity\TbHospitalUnit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbHospitalUnitsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tbHospitalUnits = $this->paginate($this->TbHospitalUnits);

        $this->set(compact('tbHospitalUnits'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Hospital Unit id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbHospitalUnit = $this->TbHospitalUnits->get($id, [
            'contain' => [],
        ]);

        $this->set('tbHospitalUnit', $tbHospitalUnit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbHospitalUnit = $this->TbHospitalUnits->newEntity();
        if ($this->request->is('post')) {
            $tbHospitalUnit = $this->TbHospitalUnits->patchEntity($tbHospitalUnit, $this->request->getData());
            if ($this->TbHospitalUnits->save($tbHospitalUnit)) {
                $this->Flash->success(__('The tb hospital unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb hospital unit could not be saved. Please, try again.'));
        }
        $this->set(compact('tbHospitalUnit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Hospital Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbHospitalUnit = $this->TbHospitalUnits->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbHospitalUnit = $this->TbHospitalUnits->patchEntity($tbHospitalUnit, $this->request->getData());
            if ($this->TbHospitalUnits->save($tbHospitalUnit)) {
                $this->Flash->success(__('The tb hospital unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb hospital unit could not be saved. Please, try again.'));
        }
        $this->set(compact('tbHospitalUnit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Hospital Unit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbHospitalUnit = $this->TbHospitalUnits->get($id);
        if ($this->TbHospitalUnits->delete($tbHospitalUnit)) {
            $this->Flash->success(__('The tb hospital unit has been deleted.'));
        } else {
            $this->Flash->error(__('The tb hospital unit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
