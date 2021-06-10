<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbQuestions Model
 *
 * @property \App\Model\Table\TbQuestionTypesTable&\Cake\ORM\Association\BelongsTo $TbQuestionTypes
 * @property \App\Model\Table\TbListOfValuesTable&\Cake\ORM\Association\BelongsTo $TbListOfValues
 * @property \App\Model\Table\TbQuestionGroupsTable&\Cake\ORM\Association\BelongsTo $TbQuestionGroups
 *
 * @method \App\Model\Entity\TbQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestion findOrCreate($search, callable $callback = null, $options = [])
 */
class TbQuestionsTable extends Table
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

        $this->setTable('tb_questions');
        $this->setDisplayField('question_idb');
        $this->setPrimaryKey('question_idb');

        $this->belongsTo('TbQuestionTypes', [
            'foreignKey' => 'question_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TbListOfValues', [
            'foreignKey' => 'list_type_id',
        ]);
        $this->belongsTo('TbQuestionGroups', [
            'foreignKey' => 'question_group_id',
        ]);
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
            ->integer('question_idb')
            ->allowEmptyString('question_idb', null, 'create');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('subordinateTo')
            ->allowEmptyString('subordinateTo');

        $validator
            ->integer('isAbout')
            ->allowEmptyString('isAbout');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['question_type_id'], 'TbQuestionTypes'));
        $rules->add($rules->existsIn(['list_type_id'], 'TbListOfValues'));
        $rules->add($rules->existsIn(['question_group_id'], 'TbQuestionGroups'));

        return $rules;
    }
}
