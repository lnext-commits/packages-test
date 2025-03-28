<?php

namespace Lnext\ServiceFacades\Traits;

use Illuminate\Database\Eloquent\Model;

/*
 |===========================================================================|===========================================================================|
 |    To create mixed options                                                |     To create boolean options                                             |
 |---------------------------------------------------------------------------|---------------------------------------------------------------------------|
 |  create table in DB for option                                            |  create table in DB for toggle option                                     |
 |---------------------------------------------------------------------------|---------------------------------------------------------------------------|
 |                                                                           |                                                                           |
 |   Schema::create('{nameTable}', function (Blueprint $table) {             |   Schema::create('{nameTable}', function (Blueprint $table) {             |
 |       $table->id();                                                       |       $table->id();                                                       |
 |       $table->unsignedInteger('{nameField}');                             |       $table->unsignedInteger('{nameField}');                             |
 |       $table->string('name');                                             |       $table->string('name');                                             |
 |       $table->{typeField}('value')->nullable();                           |       $table->boolean('value')->default(1)->nullable();                   |
 |       $table->foreign('{NameField}')->references('id')->on('{nameTable}');|       $table->foreign('{NameField}')->references('id')->on('{nameTable}');|
 |   });                                                                     |   });                                                                     |
 |                                                                           |                                                                           |
 |   Create model {NameModelNewTable} for this table                         |   Create model {NameModelNewTable} for this table                         |
 |---------------------------------------------------------------------------|---------------------------------------------------------------------------|
 |  add properties in model                                                  |  add properties in model                                                  |
 |---------------------------------------------------------------------------|---------------------------------------------------------------------------|
 |                                                                           |                                                                           |
 |   array $optionField = []                                                 |   array $toggleField = []                                                 |
 |                                                                           |                                                                           |
 |     *in it, list the fields that you want to use for the option.          |     *in it, list the fields that you want to use for the Boolean option.  |
 |---------------------------------------------------------------------------|---------------------------------------------------------------------------|
 |  add a relation in model                                                  |  add a relation in model                                                  |
 |---------------------------------------------------------------------------|---------------------------------------------------------------------------|
 |    public function option(): HasMany                                      |    public function booleanOptions(): HasMany                              |
 |    {                                                                      |    {                                                                      |
 |         return $this->hasMany({NameModelNewTable}::class);                |         return $this->hasMany({NameModelNewTable}::class);                |
 |    }                                                                      |    }                                                                      |
 |---------------------------------------------------------------------------|---------------------------------------------------------------------------|
 |  add properties for permanent loading                                     |  add properties for permanent loading                                     |
 |---------------------------------------------------------------------------|---------------------------------------------------------------------------|
 |   protected $with = [                                                     |   protected $with = [                                                     |
 |       'options',                                                          |       'booleanOptions',                                                   |
 |   ];                                                                      |   ];                                                                      |
 |===========================================================================|===========================================================================|
*/

trait EndlessOptions
{
    public function getFillable(): array
    {
        $fillable = $this->fillable;
        if (isset($this->toggleField)) {
            $fillable = array_merge($fillable, $this->toggleField);
        }
        if (isset($this->optionField)) {
            $fillable = array_merge($fillable, $this->optionField);
        }
        return $fillable;
    }

    public function getAttribute($key)
    {
        if ($this->checkFieldOption('mixed', $key)) {
            return $this->getOption($key);
        } elseif ($this->checkFieldOption('toggle', $key)) {
            return $this->getBooleanOption($key);
        } else {
            return parent::getAttribute($key);
        }
    }

    public function setAttribute($key, $value)
    {
        if ($this->checkFieldOption('mixed', $key)) {
            return $this->setOption($key, $value);
        } elseif ($this->checkFieldOption('toggle', $key)) {
            return $this->setBooleanOption($key, $value);
        } else {
            return parent::setAttribute($key, $value);
        }
    }

    public function getToggleField()
    {
        return $this->toggleField ?? [];
    }

    public function getOptionField()
    {
        return $this->optionField ?? [];
    }


    // --------- PRIVATE FUNCTION  --------------------------------------

    private function getBooleanOption($field): bool|null
    {
        return $this->booleanOptions->where('name', $field)->first()?->value;
    }

    private function getOption($field): mixed
    {
        return $this->options->where('name', $field)->first()?->value;
    }

    private function setBooleanOption($field, bool $value): Model|bool
    {
        if ($option = $this->booleanOptions->where('name', $field)->first()) {
            return $option->update(['value' => $value]);
        } else {
            return $this->booleanOptions()->create(['name' => $field, 'value' => $value]);
        }
    }

    private function setOption($field, $value): Model|bool
    {
        if ($option = $this->options->where('name', $field)->first()) {
            return $option->update(['value' => $value]);
        } else {
            return $this->options()->create(['name' => $field, 'value' => $value]);
        }
    }

    private function checkFieldOption($case, $key): bool
    {
        return match ($case) {
            'toggle' => isset($this->toggleField) && in_array($key, $this->toggleField) && method_exists($this, 'booleanOptions'),
            'mixed' => isset($this->optionField) && in_array($key, $this->optionField) && method_exists($this, 'option'),
            default => false
        };
    }

}
