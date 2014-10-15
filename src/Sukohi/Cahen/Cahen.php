<?php namespace Sukohi\Cahen;

class Cahen {
	
	private $_model;
	
	public function move($model) {
		
		$this->_model = $model;
		return $this;
		
	}
	
	public function to($column, $position) {
		
		if($position <= 0) {
			
			$position = 1;
			
		}
		
		$moving_id = $this->_model->id;
		$moving_position = $position - 1;
		$model_data = $this->_model->select('id')
						->where('id', '<>', $moving_id)
						->orderBy($column, 'ASC')
						->get();
		
		$new_position = 0;
		$moved = false;
		
		foreach ($model_data as $model_values) {
			
			if($new_position == $moving_position) {
				
				$this->_model->$column = $new_position;
				
				if(!$this->_model->save()) {
					
					return false;
					
				}
				
				$moved = true;
				$new_position++;
				
			}
			
			$model_values->$column = $new_position;
			
			if(!$model_values->save()) {
				
				return false;
				
			}
			
			$new_position++;
			
		}
		
		if(!$moved) {
			
			$this->_model->$column = $new_position;
			$this->_model->save();
			
		}
		
		return true;
		
	}
	
	public function up($column) {
		
		$position = $this->_model->$column;
		$this->to($column, $position);
		
	}
	
	public function down($column) {
		
		$position = $this->_model->$column + 2;
		$this->to($column, $position);
		
	}
	
	public function first($column) {
		
		$this->to($column, 0);
		
	}
	
	public function last($column) {
		
		$position = $this->_model->max($column) + 1;
		$this->to($column, $position);
		
	}

	public function align($model, $column) {
		
		foreach ($model as $index => $model_values) {
				
			$model_values->$column = $index;
			
			if(!$model_values->save()) {
			
				return false;
			
			}
				
		}
		
		return true;
		
	}
	
}