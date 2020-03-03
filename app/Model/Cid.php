<?php

namespace App\Model;

/**
 * @property int $id
 * @property string $cid
 * @property string $descricao
 * @property boolean $should_send_msg
 * @property boolean $is_estigmatizado
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Cid extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'cid',
        'descricao',
        'should_send_msg',
        'is_estigmatizado'
    ];

}
