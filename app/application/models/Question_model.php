<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {
	protected $_question = 'questions';
	protected $_choices = 'choices';

	function get_question()
	{
		$question_id = 1;
		$max_id = 0;
		$fetched = $this->db->select('count(question_id) as max')->get($this->_question);
		if($fetched->num_rows() > 0) $max_id = $fetched->row()->max;
		if($this->session->question && $this->session->question <= $max_id){
			$question_id = $this->session->question;
		}else{
			$this->session->question=1;
		}
		$question = $this->db
		->limit(1,$question_id-1)
		->get($this->_question)->row();
		$choices = $this->db->where('question_id',$question->question_id)->order_by('text')->get($this->_choices)->result();
		$question->choices = $choices;
		return $question;
	}

	function is_correct($question_id, $choice)
	{
		$ans = $this->db
		->where(['question_id'=>$question_id,'text'=>$choice])
		->get($this->_choices)->row();
		return $ans->is_correct;
	}

	function insertQuestion($data, $options)
	{
		$options = array_unique($options);
		foreach ($data as $key => $value) {
			$this->db->insert($this->_question, ['type'=>$value['type'],'filename'=>$value['filename']]);
			$insert_id = $this->db->insert_id();
			$this->db->insert($this->_choices, ['text'=>$value['language'],'is_correct'=>'1','question_id'=>$insert_id]);
			$options2 = array_diff($options, [$value['language']]);
			shuffle($options2);
			$langs = array_chunk($options2, 3);
			// print_r($choices[0]);
			$choices = [];
			foreach ($langs[0] as $k => $v) {
				$choices[] = ['question_id' => $insert_id, 'text'	=>	$v];
			}
			$this->db->insert_batch($this->_choices, $choices);

		}
	}
}
