<?php
/** grep class
 * set: 设置内容
 * get: 返回指定的内容
 * get_pattern 根据type返回pattern
 */

class Grep{

    private $_pattern = array(
        'dt' => '/<dt.*?>(.*?)<\/dt>/ism',
        'dd' => '/<dd.*?>(.*?)<\/dd>/ism'
    );

    private $_content = ''; // 源内容


    /* 設置搜尋的內容
    * @param String $content
    */
    public function set($content=''){
        $this->_content = $content;
    }


    /* 获取指定内容
    * @param String $type
    * @param int $unique 0:all 1:unique
    * @return Array
    */
    public function get($type='', $unique=0){

        $type = strtolower($type);

        if($this->_content=='' || !in_array($type, array_keys($this->_pattern))){
            return array();
        }

        $pattern = $this->get_pattern($type); // 获取pattern

        preg_match_all($pattern, $this->_content, $matches);

//        print_r($matches);exit();

        return isset($matches[1])? ( $unique==0? $matches[1] : array_unique($matches[1]) ) : array();

    }

    /* 根据type获取pattern
    * @param String $type
    * @return String
    */
    private function get_pattern($type){
        return $this->_pattern[$type];
    }
}

?>