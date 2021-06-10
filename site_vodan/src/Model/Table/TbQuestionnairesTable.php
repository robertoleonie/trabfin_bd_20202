<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbQuestionnaires Model
 *
 * @method \App\Model\Entity\TbQuestionnaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbQuestionnaire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbQuestionnaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionnaire|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestionnaire saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestionnaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionnaire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionnaire findOrCreate($search, callable $callback = null, $options = [])
 */
class TbQuestionnairesTable extends Table
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

        $this->setTable('tb_questionnaires');
        $this->setDisplayField('questionnaire_id');
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
}
