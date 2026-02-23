<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">進站人數管理</p>
     <form method="post" action="./api/edit_data.php?table=<?=$do;?>">
        <table width="50%" style="margin:auto;">
            <tbody>
                 <tr class="yel">
                    <td width="50%">進站總人數：</td>
                    <td>
                      <input type="number" name="total" value="<?=$Total->find(1)['total'];?>">
                      <?php
                      $data =$Total->find(1);
                      echo '<pre>';
                      print_r($data);
                      echo '<pre>';
                      ?>  
                    </td>   
                </tr>


            </tbody>   
        </table>
    </form>   








</div>    