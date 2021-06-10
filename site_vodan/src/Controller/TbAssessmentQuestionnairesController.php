<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TbAssessmentQuestionnaires Controller
 *
 * @property \App\Model\Table\TbAssessmentQuestionnairesTable $TbAssessmentQuestionnaires
 *
 * @method \App\Model\Entity\TbAssessmentQuestionnaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TbAssessmentQuestionnairesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Participants', 'HospitalUnits', 'Questionnaires'],
        ];
        $tbAssessmentQuestionnaires = $this->paginate($this->TbAssessmentQuestionnaires);

        $this->set(compact('tbAssessmentQuestionnaires'));
    }

    /**
     * View method
     *
     * @param string|null $id Tb Assessment Questionnaire id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tbAssessmentQuestionnaire = $this->TbAssessmentQuestionnaires->get($id, [
            'contain' => ['Participants', 'HospitalUnits', 'Questionnaires'],
        ]);

        $this->set('tbAssessmentQuestionnaire', $tbAssessmentQuestionnaire);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tbAssessmentQuestionnaire = $this->TbAssessmentQuestionnaires->newEntity();
        if ($this->request->is('post')) {
            $tbAssessmentQuestionnaire = $this->TbAssessmentQuestionnaires->patchEntity($tbAssessmentQuestionnaire, $this->request->getData());
            if ($this->TbAssessmentQuestionnaires->save($tbAssessmentQuestionnaire)) {
                $this->Flash->success(__('The tb assessment questionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb assessment questionnaire could not be saved. Please, try again.'));
        }
        $participants = $this->TbAssessmentQuestionnaires->Participants->find('list', ['limit' => 200]);
        $hospitalUnits = $this->TbAssessmentQuestionnaires->HospitalUnits->find('list', ['limit' => 200]);
        $questionnaires = $this->TbAssessmentQuestionnaires->Questionnaires->find('list', ['limit' => 200]);
        $this->set(compact('tbAssessmentQuestionnaire', 'participants', 'hospitalUnits', 'questionnaires'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb Assessment Questionnaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tbAssessmentQuestionnaire = $this->TbAssessmentQuestionnaires->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tbAssessmentQuestionnaire = $this->TbAssessmentQuestionnaires->patchEntity($tbAssessmentQuestionnaire, $this->request->getData());
            if ($this->TbAssessmentQuestionnaires->save($tbAssessmentQuestionnaire)) {
                $this->Flash->success(__('The tb assessment questionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb assessment questionnaire could not be saved. Please, try again.'));
        }
        $participants = $this->TbAssessmentQuestionnaires->Participants->find('list', ['limit' => 200]);
        $hospitalUnits = $this->TbAssessmentQuestionnaires->HospitalUnits->find('list', ['limit' => 200]);
        $questionnaires = $this->TbAssessmentQuestionnaires->Questionnaires->find('list', ['limit' => 200]);
        $this->set(compact('tbAssessmentQuestionnaire', 'participants', 'hospitalUnits', 'questionnaires'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb Assessment Questionnaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tbAssessmentQuestionnaire = $this->TbAssessmentQuestionnaires->get($id);
        if ($this->TbAssessmentQuestionnaires->delete($tbAssessmentQuestionnaire)) {
            $this->Flash->success(__('The tb assessment questionnaire has been deleted.'));
        } else {
            $this->Flash->error(__('The tb assessment questionnaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
