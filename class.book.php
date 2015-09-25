<?php
class book{
    
     public $user_id;
     public $name;
     public $author;
     public $genre;
     public $publisher;
     public $location;
     public $book_id;
    
    
    public function __construct($user_id,$bname,$bauthor,$bgenre,$bpublisher,$blocation,$bbook_id) {
        
        $this->user_id = $user_id;
        $this->name = $bname;
        $this->author = $bauthor;
        $this->genre = $bgenre;
        $this->publisher = $bpublisher;
        $this->location = $blocation;
        $this->book_id = $bbook_id;
    }
    
    public function display_books_search(){
                $displaybookshtml = '
                <a href="book.php?bookid='. $this->book_id .' ">
                <div class="books">

                        <div class="booksname">
                               <p><i class="fa fa-book"></i> ' . $this->name . '</p>
                        </div>
                        
                        <div class="idandauthor">
                            <div class="booksauthor">
                               <p><i class="fa fa-user"></i> ' . $this->author . '</p>
                            </div>                        
                        
                            <div class="bookidarea">
                                <p>' . $this->book_id . '</p>
                            </div>
                        </div>
                        
                    <div class="moreinfo">
                        <div class="books1st">
                             <p><i class="fa fa-circle"></i> ' . $this->genre . '</p>
                        </div>
                        <div class="books2nd">
                            <p><i class="fa fa-globe"></i> ' . $this->publisher . '</p>
                        </div>                        
                        <div class="books3rd">
                           <p> <i class="fa fa-map-marker"></i> ' . $this->location . '</p>
                        </div>                         
                    </div>                          
                        
                </div>
                </a>
        
        
        
        ';
        
        //echo "<p><h3>".$this->name."</h3>".$this->author. " " . $this->book_id . "</p>";
        echo $displaybookshtml;
    }
    
    public function display_bigbook(){
        $bigbookhtml='
        <div id="bigbookwrapper">
               <div id="bookmain">
                   
                <div id="bookmainheader">
                    <p>Book ID:</p>
                    <p>' . $this->book_id . '</p>  
                </div>   
                   <hr>
                   
                <div class="book_info_wrapper" style="margin-top: 20px;">   
                    <div class="book_info" >
                        <p><i class="fa fa-book" title="Book Name" id="big_label"></i> ' . $this->name . '</p>   
                    </div>
                    

                    
                    <div class="book_edit">
                        <i class="fa fa-pencil-square-o" title="Edit" id="edit_logo"></i> 
                    </div>
                    
                    
                    <div class="book_info_edit">	                   	
                        <form action="book_update.php" >
                            
                            <div class="book_info_input">
	                   			<input id="book_name_input" type="text" name="book_name" placeholder="Book Name" value="' . $this->name . '" maxlength="120" required/>
	                   		
                            <button type="submit" name="btn_update" value="name">
                            Update
                            </button>
                            </div>
                        </form>
                    </div> 
                    
                </div>  
                   
                <div class="book_info_wrapper">   
                    <div class="book_info">
                        <p><i class="fa fa-user" title="Author" id="big_label"></i> ' . $this->author . '</p>   
                    </div>
                    <div class="book_edit">
                        <i class="fa fa-pencil-square-o" title="Edit" id="edit_logo"></i> 
                    </div>
                    
                    <div class="book_info_edit">	                   	
                        <form action="book_update.php" >
                            
                    <div class="book_info_input">
	                   			<input id="book_name_input" type="text" name="author" placeholder="Author" value="' . $this->author . '" maxlength="100"/>
	                   		
                            <button type="submit" name="btn_update" value="author">
                            Update
                            </button>
                            </div>
                        </form>
                    </div>
                    
                </div> 
                   
                <div class="book_info_wrapper">   
                    <div class="book_info">
                        <p><i class="fa fa-circle" title="Genre" id="big_label"></i> ' . $this->genre . '</p>   
                    </div>
                    <div class="book_edit">
                        <i class="fa fa-pencil-square-o" title="Edit" id="edit_logo"></i> 
                    </div>
                    
                    <div class="book_info_edit">	                   	
                        <form action="book_update.php">   
                        <div class="book_info_input">
	                   			<input id="book_name_input" type="text" name="genre" placeholder="Genre" value="' . $this->genre . '" maxlength="40"/>
	                   		
                            <button type="submit" name="btn_update" value="genre">
                            Update
                            </button>
                        </div>
                            </form>
                    </div> 
                    
                </div> 
                   
                <div class="book_info_wrapper">   
                    <div class="book_info">
                        <p><i class="fa fa-globe"  title="Publisher" id="big_label"></i> ' . $this->publisher . '</p>   
                    </div>
                    <div class="book_edit">
                        <i class="fa fa-pencil-square-o" title="Edit" id="edit_logo"></i> 
                    </div>
                    
                    <div class="book_info_edit">	                   	
                        <form action="book_update.php" >
                            
                    <div class="book_info_input">
	                   			<input id="book_name_input" type="text" name="publisher" placeholder="Publisher" value="' . $this->publisher . '" maxlength="40"/>
	                   		
                            <button type="submit" name="btn_update" value="publisher">
                            Update
                            </button>
                            </div>
                        </form>
                    </div>
                    
                    
                </div>
                   
                <div class="book_info_wrapper">   
                    <div class="book_info">
                        <p><i class="fa fa-map-marker"  title="Location" id="big_label"></i> ' . $this->location . '</p>   
                    </div>
                    <div class="book_edit">
                        <i class="fa fa-pencil-square-o" title="Edit" id="edit_logo"></i> 
                    </div>
                    
                    <div class="book_info_edit">	                   	
                        <form action="book_update.php" >
                            
                    <div class="book_info_input">
	                   			<input id="book_name_input" type="text" name="location" placeholder="Location" value="' . $this->location . '" maxlength="40"/>
	                   		
                            <button type="submit" name="btn_update" value="location">
                            Update
                            </button>
                            </div>
                        </form>
                    </div>
                    
                </div>  
                      
               
               </div>
                
                <hr>
               

        
        
        
        
        ';
        
        echo $bigbookhtml;
    }
    
    
    public function set_book_id($nbook_id){
        $this->book_id = $nbook_id;
    }
    
    
}


?>