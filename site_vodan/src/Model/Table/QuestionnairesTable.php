<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Questionnaires Model
 *
 * @method \App\Model\Entity\Questionnaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\Questionnaire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Questionnaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Questionnaire|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Questionnaire saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Questionnaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Questionnaire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Questionnaire findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestionnairesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('questionnaires');
        $this->setDisplayField('description');
        $this->setPrimaryKey('questionnaire_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('questionnaire_id')
            ->allowEmptyString('questionnaire_id', null, 'create');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }

    public function deletar($id = null){
        
        $connection = ConnectionManager::get('default');
        $connection->begin();
        $connection->execute('CALL ps_deletar_questionnaire(?,@sucesso);', [$id]);
        $row = $connection->execute('SELECT @sucesso')->fetch('assoc');
        $connection->commit();
        return $row['@sucesso'];
    }
    public function clone($id = null){
        $connection = ConnectionManager::get('default');
        $row = $connection->execute(
            'CALL ps_clonar_questionnaire(?);',
            [$id]
        );
    }
}
