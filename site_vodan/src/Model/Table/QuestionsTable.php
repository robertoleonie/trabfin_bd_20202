<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 *
 * @property \App\Model\Table\QuestionTypesTable&\Cake\ORM\Association\BelongsTo $QuestionTypes
 * @property \App\Model\Table\ListTypesTable&\Cake\ORM\Association\BelongsTo $ListTypes
 * @property \App\Model\Table\QuestionGroupsTable&\Cake\ORM\Association\BelongsTo $QuestionGroups
 *
 * @method \App\Model\Entity\Question get($primaryKey, $options = [])
 * @method \App\Model\Entity\Question newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Question[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Question|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Question[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Question findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestionsTable extends Table
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

        $this->setTable('questions');
        $this->setDisplayField('question_id');
        $this->setPrimaryKey('question_id');

        $this->belongsTo('QuestionTypes', [
            'foreignKey' => 'question_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ListTypes', [
            'foreignKey' => 'list_type_id',
        ]);
        $this->belongsTo('QuestionGroups', [
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
            ->integer('question_id')
            ->allowEmptyString('question_id', null, 'create');

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
        $rules->add($rules->existsIn(['question_type_id'], 'QuestionTypes'));
        $rules->add($rules->existsIn(['list_type_id'], 'ListTypes'));
        $rules->add($rules->existsIn(['question_group_id'], 'QuestionGroups'));

        return $rules;
    }
}
