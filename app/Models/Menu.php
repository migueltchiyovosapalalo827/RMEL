<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id', 'active', 'nome', 'icon', 'route', 'sequence'];



    public function roles()
    {
        return $this->belongsToMany(Role::class,'menusroles');
    }

      //relacionamento (auto-relacionamento) item 4
      public function submenus()
      {
          return $this->hasMany(Menu::class, 'parent_id', 'id');
      }

      // um técnica do item 3
      public function isFather()
      {
          return is_null($this->attributes['parent_id']);
      }

      // aqui seria o item 3
      protected $appends = ['is_father'];

      public function getIsFatherAttribute()
      {
          if (isset($this->attributes['parent_id'])) {
              # code...
              return false;
          }
          return true;
      }
}
