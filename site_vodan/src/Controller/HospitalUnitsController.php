<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HospitalUnits Controller
 *
 * @property \App\Model\Table\HospitalUnitsTable $HospitalUnits
 *
 * @method \App\Model\Entity\HospitalUnit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HospitalUnitsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $hospitalUnits = $this->paginate($this->HospitalUnits);

        $this->set(compact('hospitalUnits'));
    }

    /**
     * View method
     *
     * @param string|null $id Hospital Unit id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hospitalUnit = $this->HospitalUnits->get($id, [
            'contain' => [],
        ]);

        $this->set('hospitalUnit', $hospitalUnit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hospitalUnit = $this->HospitalUnits->newEntity();
        if ($this->request->is('post')) {
            $hospitalUnit = $this->HospitalUnits->patchEntity($hospitalUnit, $this->request->getData());
            if ($this->HospitalUnits->save($hospitalUnit)) {
                $this->Flash->success(__('The hospital unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hospital unit could not be saved. Please, try again.'));
        }
        $this->set(compact('hospitalUnit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hospital Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hospitalUnit = $this->HospitalUnits->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hospitalUnit = $this->HospitalUnits->patchEntity($hospitalUnit, $this->request->getData());
            if ($this->HospitalUnits->save($hospitalUnit)) {
                $this->Flash->success(__('The hospital unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hospital unit could not be saved. Please, try again.'));
        }
        $this->set(compact('hospitalUnit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hospital Unit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hospitalUnit = $this->HospitalUnits->get($id);
        if ($this->HospitalUnits->delete($hospitalUnit)) {
            $this->Flash->success(__('The hospital unit has been deleted.'));
        } else {
            $this->Flash->error(__('The hospital unit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
