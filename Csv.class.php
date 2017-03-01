<?php
/**
 * csv 格式导出数据
 */

class Csv
{
    /**
     * @Action     导出 csv数据
     * @Param      $filename  string 文件名
     *             $title     string 标题
     *             $data      array  二维数据
     * @Return
     */
    public function orgExport($filename, $title, $data)
    {
        header("Cache-Control: public");
        header("Pragma: public");
        header("Content-type: text/csv ");
        header("Content-Disposition: attachment; filename=".$filename.".csv");
        header("Content-Type:APPLICATION/OCTET-STREAM");
        //header("Content-Type: text/html; charset=gbk");
        //header("Content-Type: text/html; charset=utf-8");

        echo  $title. "\n";
        foreach ($data as $value) {
            $str= implode(",", $value."、");
            echo $str;
            echo "\n";
        }
    }

    //第个字段前面加了个逗号，防止数值格式改变
    public function export($filename, $title, $data)
    {
        //格式化数据
        $FormatData = $this->FormatData($filename, $title, $data);

        $filename =$FormatData['filename'];
        $title =$FormatData['title'];
        $data =$FormatData['data'];

        header("Cache-Control: public");
        header("Pragma: public");
        header("Content-type: text/csv; charset=utf-8");
        header("Content-Disposition: attachment; filename=".$filename.".csv");
        header("Content-Type:APPLICATION/OCTET-STREAM");
        //header("Content-Type: text/html; charset=gbk");
        //header("Content-Type: text/html; charset=utf-8");

        echo  $title. "\n";
        foreach ($data as $value) {
            $str= "'".implode(",'", $value);
            echo $str;
            echo "\n";
        }
    }

    //没有加逗号，防止数值格式改变
    public function export2($filename, $title, $data)
    {
        //格式化数据
        $FormatData = $this->FormatData($filename, $title, $data);

        $filename =$FormatData['filename'];
        $title =$FormatData['title'];
        $data =$FormatData['data'];

        header("Cache-Control: public");
        header("Pragma: public");
        header("Content-type: text/csv; charset=utf-8");
        header("Content-Disposition: attachment; filename=".$filename.".csv");
        header("Content-Type:APPLICATION/OCTET-STREAM");
        //header("Content-Type: text/html; charset=gbk");
        //header("Content-Type: text/html; charset=utf-8");

        echo  $title. "\n";
        foreach ($data as $value) {
            $str= implode(",", $value);
            echo $str;
            echo "\n";
        }
    }

    /**
     * @Action     格式化 csv数据
     * @Param      $filename  string 文件名
     *             $title     string 标题
     *             $data      array  数据
     * @Return
     */
    public function formatData($filename, $title, $data)
    {
        $formatArr = array();
        $formatArr['filename'] = $this->transCoding($filename);
        $formatArr['title'] = $this->transCoding($title);

        foreach ($data as $key => $value) {
            $i = 0;
            $NewData = array();
            foreach ($value as $val) {
                $NewData[$i] = $this->transCoding(str_replace(',','，',str_replace("\n",'',str_replace("\r",'',$val))));
                $i++;
            }
            $formatArr['data'][$key] = $NewData;
        }
        //error_log("\n==new==\n".var_export($formatArr,true)."\n----\n",3,'data/error_0000.log');
        return $formatArr;
    }

    /**
     * @Action     转换编码
     * @Param      $data   要转化的数据
     *             $start  转换前编码
     *             $end    转换后编码
     * @Return     string
     */
    public function transCoding($data, $start = 'gbk', $end = 'utf8')
    {
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($data, $start, $end);
        } elseif (function_exists('iconv')) {
            return iconv($end, $start, $data);
        } else {
            return $data;
        }
    }

}

?>