<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssessmentQuestionnaires Controller
 *
 * @property \App\Model\Table\AssessmentQuestionnairesTable $AssessmentQuestionnaires
 *
 * @method \App\Model\Entity\AssessmentQuestionnaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentQuestionnairesController extends AppController
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
        $assessmentQuestionnaires = $this->paginate($this->AssessmentQuestionnaires);

        $this->set(compact('assessmentQuestionnaires'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessment Questionnaire id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assessmentQuestionnaire = $this->AssessmentQuestionnaires->get($id, [
            'contain' => ['Participants', 'HospitalUnits', 'Questionnaires'],
        ]);

        $this->set('assessmentQuestionnaire', $assessmentQuestionnaire);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assessmentQuestionnaire = $this->AssessmentQuestionnaires->newEntity();
        if ($this->request->is('post')) {
            $assessmentQuestionnaire = $this->AssessmentQuestionnaires->patchEntity($assessmentQuestionnaire, $this->request->getData());
            if ($this->AssessmentQuestionnaires->save($assessmentQuestionnaire)) {
                $this->Flash->success(__('The assessment questionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment questionnaire could not be saved. Please, try again.'));
        }
        $participants = $this->AssessmentQuestionnaires->Participants->find('list', ['limit' => 200]);
        $hospitalUnits = $this->AssessmentQuestionnaires->HospitalUnits->find('list', ['limit' => 200]);
        $questionnaires = $this->AssessmentQuestionnaires->Questionnaires->find('list', ['limit' => 200]);
        $this->set(compact('assessmentQuestionnaire', 'participants', 'hospitalUnits', 'questionnaires'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assessment Questionnaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessmentQuestionnaire = $this->AssessmentQuestionnaires->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessmentQuestionnaire = $this->AssessmentQuestionnaires->patchEntity($assessmentQuestionnaire, $this->request->getData());
            if ($this->AssessmentQuestionnaires->save($assessmentQuestionnaire)) {
                $this->Flash->success(__('The assessment questionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment questionnaire could not be saved. Please, try again.'));
        }
        $participants = $this->AssessmentQuestionnaires->Participants->find('list', ['limit' => 200]);
        $hospitalUnits = $this->AssessmentQuestionnaires->HospitalUnits->find('list', ['limit' => 200]);
        $questionnaires = $this->AssessmentQuestionnaires->Questionnaires->find('list', ['limit' => 200]);
        $this->set(compact('assessmentQuestionnaire', 'participants', 'hospitalUnits', 'questionnaires'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assessment Questionnaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessmentQuestionnaire = $this->AssessmentQuestionnaires->get($id);
        if ($this->AssessmentQuestionnaires->delete($assessmentQuestionnaire)) {
            $this->Flash->success(__('The assessment questionnaire has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment questionnaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
