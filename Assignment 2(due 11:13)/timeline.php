<?php
    class TimeLine {
        # Ex 2 : Fill out the methods
        private $db;
        function __construct()
        {
            # You can change mysql username or password
            $this->db = new PDO("mysql:host=localhost;dbname=timeline", "root", "root");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        public function add($tweet) // This function inserts a tweet
        {
            //Fill out here
            $author=$tweet[0];
            $author=$this->db->quote($author);
            $contents=$tweet[1];
            $contents=$this->db->quote($contents);
            $this->db->exec("INSERT into tweets(author,contents,time) values($author,$contents,now())");
        }
        public function delete($no) // This function deletes a tweet
        {
            //Fill out here
            $no=$this->db->quote($no);
            $this->db->exec("DELETE from tweets where no=$no");
        }
        # Ex 6: hash tag
        # Find has tag from the contents, add <a> tag using preg_replace() or preg_replace_callback()
        public function loadTweets() // This function load all tweets
        {
            //Fill out here
            $rows=$this->db->query("SELECT * from tweets order by time desc");
            $rows=$rows->fetchAll();
            $i=0;
            foreach($rows as $row){
                    $contents=$row['contents'];
                        if(strpos($row['contents'],"#039")> -1){

                        }
                        else{
                            
                            $replace = "<a href=\"index.php?type=Content&query=%23$1\">#$1</a>";
                            $contents=preg_replace("/#([_]*[a-zA-Z0-9가-힣]+[\w가-힣]*)/",$replace,$contents);
                            
                        }
                        $rows[$i]['contents']=$contents;
                        $i++;
                    }
            return $rows;
        }
        public function searchTweets($type, $query) // This function load tweets meeting conditions
        {
            //Fill out here
            if (!strcmp($type,"Author")){
                //$query=$this->db->quote($query);
                $rows=$this->db->query("SELECT * from tweets where author like '%$query%' order by time desc");
                $rows=$rows->fetchAll();
                $i=0;
                foreach($rows as $row){
                    $contents=$row['contents'];
                        if(strpos($row['contents'],"#039")> -1){

                        }
                        else{
                            
                            $replace = "<a href=\"index.php?type=Content&query=%23$1\">#$1</a>";
                            $contents=preg_replace("/#([_]*[a-zA-Z0-9가-힣]+[\w가-힣]*)/",$replace,$contents);
                            
                        }
                        $rows[$i]['contents']=$contents;
                        $i++;
                    }
                    return $rows;
            }
            else if(!strcmp($type,"Content")){
                //$query=$this->db->quote($query);
                $query=htmlspecialchars($query,ENT_QUOTES);
                $rows=$this->db->query("SELECT * from tweets where contents like '%$query%' order by time desc");
                $rows=$rows->fetchAll();
                $i=0;
                foreach($rows as $row){
                    $contents=$row['contents'];
                        if(strpos($row['contents'],"#039")> -1){

                        }
                        else{
                            
                            $replace = "<a href=\"index.php?type=Content&query=%23$1\">#$1</a>";
                            $contents=preg_replace("/#([_]*[a-zA-Z0-9가-힣]+[\w가-힣]*)/",$replace,$contents);
                            
                        }
                        $rows[$i]['contents']=$contents;
                        $i++;
                    }
            }
            return $rows;

        }
    }
?>
