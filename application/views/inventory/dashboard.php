<!-- <?php print_r($result) ; ?> -->
<?php
    if(!$_SESSION['ename'] AND !$_SESSION['EmployeeID']){
        redirect('inventory/inController/inlogin');
    }
        $EmployeeId = $this->session->userdata('EmployeeID');
            
?> 
<!DOCTYPE html>
<html>
<head>
    <title>DASHBOARD</title>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
    
</head>
<style type="text/css">    
    ul{
        list-style-type: none;
    }
    button{
        margin-right: 5px;
    }

.wells { background: #f5f5f5; padding:15px; display: inline-block; font-size: 20px; border: 1px solid #e3e3e3; border-radius: 5px; text-align: center; }

</style>

<body>

    <center><h2 class="well" style="margin-top: 0px;">Office Inventory System</h2></center>
    <div class="container">        
        <div class="row">
            <h4>
                <?php            
                echo "<b>";           
                echo "Welcome ". $this->session->userdata('ename')."<br /></b>";
                ?>
            </h4>           
            <div class="col-lg-2">
                        
            <img src="<?php echo base_url();?>user.jpeg" class="img-circle img-responsive">
            <br>
                <h4>Categories</h4>
                <div>
                    <ul>                    
                    <li onclick="clickedCategory(this);"><a href="#"><span class="glyphicon glyphicon-plus"></span> HouseKeeping</a>
                        <ul id="houseKeeping" style="display: none;">
                            <li class="space">Hand Lotion</li>
                            <li class="space">Body Wash</li>
                            <li class="space">Toilet Paper</li>
                            <li class="space">Hand Soap</li>
                            <li class="space">Floor Cleaner</li>
                        </ul>                                                            
                    </li>                   
                    <li onclick="clickedCategory(this);"><a href="#"><span class="glyphicon glyphicon-plus"></span> Pantery</a>
                        <ul id="pantery" style="display: none;">
                            <li class="space">Plastic Cups</li>
                            <li class="space">Coffee</li>
                            <li class="space">Tea</li>
                            <li class="space">Tissues</li>
                            <li class="space">Biscuits</li>
                        </ul>                            
                    </li>
                    <li onclick="clickedCategory(this);"><a href="#"><span class="glyphicon glyphicon-plus"></span> Stationary</a>      
                        <ul id="stationary" style="display: none;">
                            <li class="space">File</li>
                            <li class="space">Pen</li>
                            <li class="space">Marker</li>
                            <li class="space">Tape</li>
                            <li class="space">Clips</li>
                        </ul>
                    </li>
                    </ul>                   
                </div>
                <button><a href="<?php echo base_url().'inventory/inController/logout'; ?>">Log Out</a></button>
            </div>
            <div class="col-lg-10">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-6" style="text-align: center;">
                           <h4><div>Your Office Locations</div></h4>
                           <div id="office" class="option">
                            <?php
                                $EmployeeId = $this->session->userdata('EmployeeID');
                                $i = 0;
                                for ($i; $i < count($result); $i++){
                                    echo "<button class='btn btn-info' onclick='office(this);' id=$i>".$result[$i][0]->{'locationName'};
                                    echo "</button>";
                                }
                            ?> 
                            </div> 
                        </div>
                        <div class="col-lg-6" style="text-align: center;">
                            <h4><div>Categories</div></h4>
                            <div id=category>
                                <button class="btn btn-info" id=1 onclick='category(this);'>HouseKeeping</button>
                                <button class="btn btn-info" id=2 onclick='category(this);'>Pantary</button>
                                <button class="btn btn-info" id=3 onclick='category(this);'>Stationary</button>
                            </div>
                        </div>
                    </div>                
                    <br>                 
                    <table class="table table-responsive">
                        <thead>
                            <tr> 
                                <th>ITEM ID</th>                          
                                <th>ITEM NAME</th>
                                <th>ITEM QUANTITY</th>
                                <th>QUANTITY USED</th>
                            </tr>  
                        </thead>
                        <tbody id="show">    
                        </tbody>
                    </table>        
                </div>                
            </div> 
        </div>
    </div>
</body>
</html>
<script>
var officeId = 0;
var categoryId = 1;   

    function office(item){
        // this is office id
        $(item).removeClass('btn btn-info');
        $(item).addClass('btn btn-primary');        
        officeId = parseInt($(item).attr('id'))+ 1;
        showAllData();
        //alert(officeId);                                        
        //return officeID;
    }

    function category(item){
        $(item).removeClass('btn btn-info');
        $(item).addClass('btn btn-primary');
        categoryId = $(item).attr('id');
        showAllData();        
        //return categoryId;
    }

    function showAllData()
    {
        //var officeId = office(item);
        //var categoryId = category(item);
        $.ajax({
            url: '<?php echo base_url(); ?>inventory/inController/showAllData',
            data: {'officeID': officeId,'categoryId':categoryId},
            datatype: 'json',
            type:'post',       
            success: function(data)
            { 
                var html="";
                data = JSON.parse(data);
                /*alert(data); */              
                $.each(data, function(i, key) {
                    html+= '<tr>'+
                            '<td>'+key.itemId+'</td>'+                            
                            '<td>'+key.itemName+'</td>'+
                            '<td id="'+key.quantity+'">'+key.quantity+'</td>'+
                            '<td>'+'<input type="number" min=0 id="'+key.itemId+'"/>'+' '+
                                    '<input type="submit" value="Update" onclick="submit(this);" class="btn btn-info item-edit" />'+'</td>'+
                           '</tr>'
                });
                $("#show").html(html);
                $("#show").attr('data-id', officeId);
                $("#show").attr('data-btnid',categoryId );
                
            },
            error: function()
            {
                alert('...Cannot Not Display...');
            }
        });
    }      
         
    function clickedCategory(item){   
        $(item).children('ul').toggle();
        /*var categorieId = $(item).attr('id');
        showAllData(categorieId);*/             
    }

    function submit(item){
        var updatedOn = "<?php date_default_timezone_set('Asia/Kolkata');                       echo date('Y-m-d H:i:s'); echo gmdate('l'); ?>"        
        /*alert(updatedOn);*/                
        var EmployeeID = '<?php echo $this->session->userdata("EmployeeID"); ?>';
        var officeID = $(item).parents('tbody').attr('data-id');        
        var itemId = $(item).prev().attr('id');
        var consumed = $(item).prev().val();
        var quantity = parseInt($(item).parent().prev().attr('id')) - parseInt(consumed);
              
        $.ajax({
            url:'<?php echo base_url(); ?>inventory/inController/insertData',
            data:{'itemId':itemId,'officeID':officeID,'quantity': quantity,'consumed': consumed,'EmployeeID' : EmployeeID,'updatedOn':updatedOn },
            datatype: 'json',
            type:'post',
            success: function(){
                alert("Updated!");
                showAllData(officeID);
               /* $(location).attr('href',"<?php echo base_url(); ?>inController/dashboard");*/
            },
            error: function(){
                alert('fail');
            }
        });        
    };   
    
    
</script>