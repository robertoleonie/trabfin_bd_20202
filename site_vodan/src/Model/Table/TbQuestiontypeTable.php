<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbQuestiontype Model
 *
 * @method \App\Model\Entity\TbQuestiontype newEmptyEntity()
 * @method \App\Model\Entity\TbQuestiontype newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestiontype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestiontype get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbQuestiontype findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TbQuestiontype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestiontype[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestiontype|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestiontype saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestiontype[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TbQuestiontype[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TbQuestiontype[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TbQuestiontype[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TbQuestiontypeTable extends Table
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

        $this->setTable('tb_questiontype');
        $this->setDisplayField('questionTypeID');
        $this->setPrimaryKey('questionTypeID');
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
            ->integer('questionTypeID')
            ->allowEmptyString('questionTypeID', null, 'create');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }
}
