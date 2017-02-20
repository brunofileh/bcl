<?php

namespace app\models;

use Yii;

class Models extends \yii\db\ActiveRecord {

	public function afterFind() {
		parent::afterFind();

		if ($this->getTableSchema()->columns) {
			foreach ($this->getTableSchema()->columns as $key => $value) {

				if ($value->type == 'date' && $this->$key) {
					$this->$key = Models::formataDataDoBanco($this->$key);
				}
			}
		}
		return true;
	}

	public function beforeSave($insert) {	

		if ($this->getTableSchema()->columns) {
			foreach ($this->getTableSchema()->columns as $key => $value) {

				if ($value->type == 'date' && $this->$key) {
					$this->$key = Models::formataDataParaBanco($this->$key);
				}
			}
		}
		return parent::beforeSave($insert);
	}	
	
	public static function decimalFormatForBank($string) {
		if ($string != ",") {
			$string = str_replace(',', '.', str_replace('.', '', $string));
		} else {
			$string = null;
		}

		return $string;
	}

	public static function decimalFormatToBank($string) {
		if ($string) {
			$string = number_format($string, 2, ',', '.');
		}

		return $string;
	}

	public static function formataDataParaBanco($data) {
		$date = explode('/', $data);

		if ($date[0]) {
			$date = $date[2] . '-' . $date[1] . '-' . $date[0];
		} else {
			$date = null;
		}
		return $date;
	}

	public static function formataDataDoBanco($data) {
		$date = explode('-', $data);

		if ($date[0]) {
			$date = $date[2] . '/' . $date[1] . '/' . $date[0];
		} else {
			$date = null;
		}
		return $date;
	}

}
