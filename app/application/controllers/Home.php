<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('question_model');
	}
	public function index()
	{
		$data['title'] =	'Home';
		$this->template->load('frontend','frontend/home',$data);
		// $this->load->view('welcome_message',$data);
	}
	/**
	 * Initialize
	 */
	public function start()
	{
		$session = [
			'question' => (null != $this->session->question) ? $this->session->question : 1,
			'lives'	=>	3,
			'score'	=>	0
		];
		$this->session->set_userdata($session);
		redirect('playing');
	}
	/**
	 * Playing
	 */
	public function playing()
	{
		$this->load->model('question_model');
		// $this->form_validation->set_rules('question_id','Question','trim|numeric|required');
		// $this->form_validation->set_rules('choice','Answer','trim|required');
		// if($this->form_validation->run() === false){
		// 	if($this->session->lives && $this->session->lives  > 0 ){
				$this->template->load('frontend','frontend/playing');	
		// 	}else{
		// 		redirect('start');
		// 	}
		// }else{
		// 	$post = $this->input->post();
		// 	$is_correct = $this->question_model->is_correct($post['question_id'],$post['choice']);
		// 	if($is_correct){
		// 		$this->session->score = $this->session->score + 50;
		// 	}else{
		// 		$this->session->lives = $this->session->lives - 1;
		// 	}
		// 	$data['answer'] = $post['choice'];
		// 	$data['is_correct'] = $is_correct;
		// 	$data['question'] = $this->question_model->get_question();
		// 	$this->template->load('frontend','frontend/playing',$data);
		// }
	}

	function next()
	{
		header('Content-Type:application/json');
		$this->session->question = $this->session->question + 1;
		$this->load->model('question_model');
		// $this->form_validation->set_rules('question_id','Question','trim|numeric|required');
		// $this->form_validation->set_rules('choice','Answer','trim|required');
		// if($this->form_validation->run() === false){
			// if($this->session->lives && $this->session->lives > 0){
				$data['question'] = $this->question_model->get_question();
				exit(json_encode($data));
				// $this->template->load('frontend','frontend/playing',$data);	
			// }else{
			// 	redirect('start');
			// }
		// }else{
		// 	$post = $this->input->post();

		// 	$is_correct = $this->question_model->is_correct($post['question_id'],$post['choice']);
		// 	if($is_correct){
		// 		$this->session->score = $this->session->score + 50;
		// 	}else{
		// 		$this->session->lives = $this->session->lives - 1;
		// 	}
		// 	$data['answer'] = $post['choice'];
		// 	$data['is_correct'] = $is_correct;
		// 	$data['question'] = $this->question_model->get_question();
		// 	$this->template->load('frontend','frontend/playing',$data);
		// }		
	}

	function import()
	{
		set_time_limit(0);
		$handle = fopen(FCPATH.'Language.csv', 'r');
		$line = fgetcsv($handle);echo "<pre>";
		$options = [];
		$questions = [];
		while ($line = fgetcsv($handle)) {
			$options[] = $line[1];
			$questions[] = [
				'type'	=>	$line[6],
				'filename'	=>	str_replace('https://drive.google.com/open?id=', 'https://docs.google.com/uc?id=', $line[7]),
				'language'	=>	$line[1]
			];
		}
		$this->question_model->insertLanguages( $options );
		$this->question_model->insertQuestion( $questions, $options );
	}
}
