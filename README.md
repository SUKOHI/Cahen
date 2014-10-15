Cahen
=====

A PHP package mainly developed for Laravel to manage order numbers of DB.

Installation&setting for Laravel
====

After installation using composer, add the followings to the array in  app/config/app.php

    'providers' => array(  
        ...Others...,  
        'Sukohi\Cahen\CahenServiceProvider',
    )

Also

    'aliases' => array(  
        ...Others...,  
        'Cahen' => 'Sukohi\Cahen\Facades\Cahen',
    )

Usage
====

**Basic moving**

    $model = Something::find(1);
    Cahen::move($model)->to('position', 5);

**Up**

    Cahen::move($model)->up('position');

**Down**

    Cahen::move($item)->down('position');
		
**to First**

    Cahen::move($item)->first('position');

**to Last**

    Cahen::move($item)->last('position');
    
**with Transaction**

    DB::beginTransaction();
    
    if(!Cahen::move($item)->to('position', 5)) {
    	
	    DB::rollback();
	
    }
    
    DB::commit();
    
**Alignment**

    $model = Something::orderBy('id', 'ASC')->get();
    Cahen::align($model, 'position');
