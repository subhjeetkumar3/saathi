<!DOCTYPE html>
<html>
<head> 
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #000;
  text-align: left;
  padding: 8px;
}

.header_table td,.header_table th{border: 0px !important;}

/*tr:nth-child(even) {
  background-color: #dddddd;
}*/

.table_1 tr th { background: #dddddd; width: 25%}
.table_1 tr td {  width: 25%}

.table_1 tr td:nth-child(1) { background: #dddddd; font-weight: bold;}
.table_1 tr td:nth-child(3) { background: #dddddd; font-weight: bold;}

.table_2 thead tr th{background: #dddddd;}
.table_2 tbody tr:nth-child(1) {background: #dddddd;}
.table_2 tbody tr:nth-child(1) td{width: 20%;}
.table_2 tr th{width: 50%;}
.table_3 tr th{background: #dddddd;}


</style>

   <?php $campCode = explode('/', $campReport[0]['camp_code']);  

   $header = '<div class="header_table"><table width="100%" style="vertical-align: bottom; font-family: serif; height:border:0;">
<tr><td width="50%"><h3 style="color:black">SAATHII: Sahay project</h3><br><h4 style="color:black">Community Based Screening (CBS):-Camp/Event Summary Report</h4><br><h3>Camp Code :'.$campCode[0].'/'.$campCode[1].'/'.$campCode[2].'</h3></td>
<td width="20%" align="center"></td><td width="30%" style="text-align: right;"><img src="http://101.53.136.41/sahya/wp-content/uploads/2018/06/21logo.png" width="126px" /></td>
</tr></table></div>'; ?>   



<?php $mpdf->setAutoTopMargin = 'stretch'; $mpdf->SetHTMLHeader($header);  ?>



 <table class="table table-bordered table_1">
               <thead>
                  <tr>
                     <th colspan="4">A. Basic Details</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>State</td>
                     <td><?php echo $stateDetails[0]['stateName'] ?></td>
                     <td>Site</td>
                     <td><?php echo $campReport[0]['site']; ?></td>
                  </tr>
                  <tr>
                     <td>District</td>
                     <td><?php echo $districtDetails[0]['districtName'] ?></td>
                     <td>Date</td>
                     <td><?php echo date('d-m-Y',strtotime($campReport[0]['date_of_camp'])) ; ?></td>
                  </tr>
                  <tr>
                     <td rowspan="2">Block</td>
                     <td rowspan="2"><?php echo $campReport[0]['block']; ?></td>
                     <!-- <td>Time</td> -->
                     <!-- <td><?php echo date('H:i:s',strtotime($campReport[0]['date_of_camp'])) ; ?></td> -->
                      <td>Start Time</td>
                     <td><?php echo date('H:i:s',strtotime($campReport[0]['start_time'])) ; ?></td>
                     <tr>
                       <!--  <td></td> -->
                     <td>End Time</td>
                     <td><?php echo date('H:i:s',strtotime($campReport[0]['end_time'])) ; ?></td>
                  </tr>
                  <tr>
                     <td>Latitude</td>
                     <td><?php echo $campReport[0]['latitude']; ?></td>
                     <td>Longitude</td>
                     <td><?php echo $campReport[0]['longitude']; ?></td>
                  </tr>
               </tbody>
            </table>
            <table class="table table-bordered table_2">
               <thead>
                  <tr>
                     <th colspan="5">B. PEOPLE PRESENT </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>NO. </td>
                     <td>NAME </td>
                     <td>DESIGNATION </td>
                     <td>ORGANISATION</td>
                     <td>CONTACT INFO. </td>
                  </tr>

                <?php if($peoplePresent){ ?>  
                 <?php $k = 1; foreach ($peoplePresent as $key => $value) {?>    
                  <tr>
                     <td><?php echo $k ?></td>
                     <td><?php echo $value['name'] ?></td>
                     <td><?php echo $value['designation'] ?></td>
                     <td><?php echo $value['organisation'] ?></td>
                     <td><?php echo $value['contactInfo'] ?></td>
                  </tr>
                 <?php $k++; }?> 
                 <?php }?> 

                   <tr>
                     <td></td>
                     <td> </td>
                     <td></td>
                     <td></td>
                     <td> </td>
                  </tr>
               </tbody>
              
            </table>
            <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th> C. JUSTIFICATION OF CAMP LOCATION  </th>
                     <th> COORDINATION FOR CAMP MOBILIZATION   </th>
                  </tr>
               </thead>
               <tbody>
                     

                  <tr>
                     <td>Distance from nearest ICTC:  <?php echo $campReport[0]['nearset_ictc']; ?></td>
                     <td>
                        <?php $array = explode(',',$campReport[0]['coordinated_with']) ?>
                        <div class="row">
                           <div class="col-md-6" style="float: left;">
                              DAPCU/ICTC/SACS <input <?php if(in_array('DAPCU',$array)|| in_array('ICTC',$array) || in_array('SACS',$array) ){echo 'checked="checked"';}?> type="radio" name="">

                           </div>
                           <div class="col-md-6" style="float: right;">
                              HIV Nodal  <input <?php if(in_array('HIV Nodal',$array)){echo 'checked="checked"';}?> type="radio"  name="">
                           </div>
                        </div>
                     </td>
                     </td>
                  </tr>
                  <tr>
                     <td>Distance from nearest Health facility: <?php echo $campReport[0]['nearest_health_facility']; ?></td>
                     <td>
                        <div class="row">
                           <div class="col-md-6" style="float: left;">
                              TI/LWS <input <?php if(in_array('LWS',$array) || in_array('TI',$array)){echo 'checked="checked"';}?> type="radio" name="">
                           </div>
                           <div class="col-md-6" style="float: right;">
                              ASHA/ANM  <input <?php if(in_array('ASHA',$array) || in_array('ANM',$array) ){echo 'checked="checked"';}?>  type="radio" name="">
                           </div>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>Distance from nearest HIV service provider:  <?php echo $campReport[0]['nearest_hiv_service_provider']; ?></td>
                     <td>Others:</td>
                     <input type="radio" <?php if(in_array('Others',$array)){echo 'checked="checked"';}?>  name="">
                  </tr>
               </tbody>
            </table>
            <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th colspan="3"> COMMUNITY PROFILE (Fill in numbers)  </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Estimated HRG: <?php echo $campReport[0]['hrg_population']; ?></td>
                     <td>Estimated ARG:  <?php echo $campReport[0]['arg_population']; ?></td>
                     <td>In/Out Migrants: <?php echo $campReport[0]['in_migration'].'/'.$campReport[0]['out_migration'] ; ?></td>
                  </tr>
                  <tr>
                     <td colspan="3">*No. of Labourers <span style="font-style: italic;font-size: 10px;">(only fill when camp is at factory/ construction site):</span> <?php echo $campReport[0]['no_of_labourers']; ?></td>
                  </tr>
               </tbody>
            </table>
            <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th >D. ACTIVITY DESCRIPTION (Describe the activities done at the camp site related to Community
                        Mobilization, HIV awareness and Group Counselling and HIV Risk profiling.)   
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><?php echo $campReport[0]['activityDesc']; ?></td>
                  </tr>
               </tbody>
            </table>
            <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th colspan="3" >E. KEY OUTPUTS 
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>NO.</td>
                     <td>INDICATORS </td>
                     <td>ACHEIVEMENT </td>
                  </tr>
                  <tr>
                     <td>E.1 </td>
                     <td>Number of people who attended the event </td>
                     <td><?php echo $campReport[0]['no_of_people_attended'] ?></td>
                  <tr>
                     <td>E.2 </td>
                     <td>Number of clients screened for HIV through Whole Blood Finger Prick Screening </td>
                     <td><?php echo $campReport[0]['no_of_people_screened']; ?> </td>
                  </tr>
                  </tr>
                  <tr>
                     <td>E.3 </td>
                     <td>Number of clients found Single Test Reactive through Whole Blood Finger Prick Screening</td>
                     <td> <?php echo $campReport[0]['no_of_people_found_to_be_str']; ?></td>
                  </tr>
                  <tr>
                     <td>E.4 </td>
                     <td>Number of Single Test Reactive (STR) clients referred to SA-ICTC for confirmatory tests </td>
                     <td> <?php echo $campReport[0]['no_of_str_cases_referred_to_ictc']; ?></td>
                  </tr>
               </tbody>
            </table>
            <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th >F. CHALLENGES</th>
                     <th >G. INNOVATIONS (to address the challenges) </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><?php echo $campReport[0]['challenges']; ?></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td><?php echo $campReport[0]['innovations']; ?></td>
                     <td></td>
               </tbody>
            </table>
            <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th >H. NEW LEARNING </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><?php echo $campReport[0]['learing']; ?></td>
                  </tr>
                  <tr>
                     <td></td>
               </tbody>
            </table>
            <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th >I. FOLLOW-UP (with STR cases / on new learning) </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><?php echo $campReport[0]['follow']; ?></td>
                  </tr>
                  <tr>
                     <td></td>
               </tbody>
            </table>
            <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th >ANY OTHER REMARKS </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><?php echo $campReport[0]['other_remark']; ?></td>
                  </tr>
                  <tr>
                     <td></td>
               </tbody>
            </table>

             <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th colspan="6">K. TOTAL EXPENSES of the camp/event (attach proper supporting documents) </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Total Cost for
conducting CBS</td>

<td>Cost of renting
locations and
assets 
</td>
<td>Cost of special
mobilisation
activities</td>

<td>Cost of
consumables </td>

<td>Cost of transporting
personnel and cold
chain for kits 
</td>

<td>Any other major
cost involved 
</td>
                  </tr>
                  <tr>
                     <td><?php echo $campReport[0]['cost_for_cbs']; ?></td>
                     <td><?php echo $campReport[0]['cost_for_renting']; ?></td>
                     <td><?php echo $campReport[0]['cost_of_mobilisation']; ?></td>
                     <td><?php echo $campReport[0]['cost_of_consumables']; ?></td>
                     <td><?php echo $campReport[0]['cost_of_transporting']; ?></td>
                     <td><?php echo $campReport[0]['other_major_cost']; ?></td>

               </tbody>
            </table>


                         <table class="table table-bordered table_3">
               <thead>
                  <tr>
                     <th colspan="11">L. KITS STATUS 
 </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Name
of the
kit 
</td>

<td>Batch
No. 

</td>
<td>Expiry
date 
</td>

<td>Opening
stock 
 </td>

<td>Received 
</td>

<td>Consumed  
</td>

<td>Control </td>
<td>Wastage/
Damage</td>

<td>Closing
stock 
</td>
<td>Quantity
Indented </td>

<td>Kits returned,
if any</td>
                  </tr>
                  <tr>
                     <td><?php echo $campReport[0]['kits_name']; ?></td>
                     <td><?php echo $campReport[0]['batch_no']; ?></td>
                     <td><?php echo $campReport[0]['expiry_date']; ?></td>
                     <td><?php echo $campReport[0]['opening_stock']; ?></td>
                     <td><?php echo $campReport[0]['received']; ?></td>
                     <td><?php echo $campReport[0]['consumed']; ?></td>
                     <td><?php echo $campReport[0]['control']; ?></td>
                     <td><?php echo $campReport[0]['wastage']; ?></td>
                     <td><?php echo $campReport[0]['closing_stock']; ?></td>
                     <td><?php echo $campReport[0]['quantity_indented']; ?></td>
                     <td><?php echo $campReport[0]['kits_returned']; ?></td>
                     
                     
               </tbody>
            </table>

             <table class="table table-bordered table_3">
                <thead>
                  <tr>
                     <th colspan="11">Camp Report Status : 
                  </th>
                  </tr>
               </thead>
               <tbody>
                  <?php if($campReport[0]['submit'] == 'N'){?>
                   <td>Not submitted</td>
                <?php }else{?>
                  <td>Submitted</td>
               <?php }?>
               </tbody>
             </table>            

<!-- </body>
</html>
