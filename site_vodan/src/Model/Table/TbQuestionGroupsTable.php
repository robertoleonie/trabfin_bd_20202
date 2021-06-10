<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbQuestionGroups Model
 *
 * @method \App\Model\Entity\TbQuestionGroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbQuestionGroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroup|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestionGroup saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestionGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class TbQuestionGroupsTable extends Table
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

        $this->setTable('tb_question_groups');
        $this->setDisplayField('question_group_id');
        $this->setPrimaryKey('question_group_id');
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
            ->integer('question_group_id')
            ->allowEmptyString('question_group_id', null, 'create');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('comment')
            ->maxLength('comment', 255)
            ->allowEmptyString('comment');

        return $validator;
    }
}
