<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbQuestiongroupformrecord Model
 *
 * @method \App\Model\Entity\TbQuestiongroupformrecord newEmptyEntity()
 * @method \App\Model\Entity\TbQuestiongroupformrecord newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TbQuestiongroupformrecord[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TbQuestiongroupformrecordTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tb_questiongroupformrecord');
        $this->setDisplayField('questionGroupFormRecordID');
        $this->setPrimaryKey('questionGroupFormRecordID');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('questionGroupFormRecordID')
            ->allowEmptyString('questionGroupFormRecordID', null, 'create');

        $validator
            ->integer('formRecordID')
            ->requirePresence('formRecordID', 'create')
            ->notEmptyString('formRecordID');

        $validator
            ->integer('crfFormsID')
            ->requirePresence('crfFormsID', 'create')
            ->notEmptyString('crfFormsID');

        $validator
            ->integer('questionID')
            ->requirePresence('questionID', 'create')
            ->notEmptyString('questionID');

        $validator
            ->integer('listOfValuesID')
            ->allowEmptyString('listOfValuesID');

        $validator
            ->scalar('answer')
            ->maxLength('answer', 512)
            ->allowEmptyString('answer');

        return $validator;
    }
}
