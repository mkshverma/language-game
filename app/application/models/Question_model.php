<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {
	protected $_question = 'questions';
	protected $_choices = 'choices';

	function get_question()
	{
		$question_id = 1;
		$max_id = 0;
		$fetched = $this->db->select('max(question_id) as max')->get($this->_question);
		// print_r($fetched->row());die;
		if($fetched->num_rows() > 0) $max_id = $fetched->row()->max;
		if($this->session->question && $this->session->question <= $max_id){
			$question_id = $this->session->question;
		}else{
			$this->session->question=1;
		}
		$question = $this->db
		->where('question_id',$question_id)
		->get($this->_question)->row();
		$choices = $this->db->where('question_id',$question_id)->get($this->_choices)->result();
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
}
