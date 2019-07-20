<style>
    .content2 h3{
    text-align: center;
    font-weight: bold;
    font-size: 18px;
    background: #d3f5f3;
    padding: 15px 0px;
}
   .content2 thead tr th, .content2 tbody tr td {
    padding: 15px 0px;
    text-align: center;
    font-weight: normal;
    border: 1px solid #ccc;
}
</style>



    <h3>Report ID- <?php echo $reportData[0]['report_unique_id'] ?></h3>

<table >
<thead>

       <tr><th>First Name :- </th><td><?php echo $reportData[0]['firstName'] ; ?></td></tr>
      <tr><th>Last Name :- </th><td><?php echo $reportData[0]['lastName'] ; ?></td></tr>
 <tr><th>Incidence addressed by whom – (Internal) :-</th>
    <td><?php echo $reportData[0]['incidence_addressed_internal'] ?></td></tr>
 <tr><th>Incidence addressed by whom (External):-</th><td>
    <?php echo $reportData[0]['incidence_addressed_external'] ?></td></tr>
 <tr><th>Date of Incidence :-</th><td><?php if($reportData[0]['date_of_incidence']) echo $reportData[0]['date_of_incidence']; ?></td></tr>
 <tr><th>Date of Incidence Reporting:-</th><td><?php if($reportData[0]['date_of_incidence_reported']) echo $reportData[0]['date_of_incidence_reported'] ?></td></tr>
 <tr><th>Place of Incidence (state, district):- </th><td><?php echo $reportData[0]['incidenceState'].','.$reportData[0]['incidenceDistrict'] ?></td></tr>
 <tr><th>Status:- </th><td><?php if(!$reportData[0]['status']) "OPEN"; else echo $reportData[0]['status']; ?></td></tr>
 <tr><th>Brief description:- </th><td><?php echo $reportData[0]['description']?></td></tr>
 <tr><th>Type of Incidence:-</th><td><?php echo $reportData[0]['type_of_incidence'] ?></td></tr>
</thead>
</thead>
<!-- <tr>
  <th>Date of report received </th>
 <th>Incidence addressed by whom – (Internal)</th>
 <th>Incidence addressed by whom (External)</th>
 <th>Date of incidence addressed</th>
 <th>Types of services provided </th>
 <th>Method of resolving (Formal / Informal) </th>
 <th>Status </th>
 <th>Brief description </th>
 <th>If pending , reason/s? </th>
</tr>
</thead> -->
  <!--   <tbody>     
  <?php if($reportData && !$reportHistory) {?>      
    <?php  foreach($reportData as $value) { ?>
    <tr >
        
        <td><?php echo date('d-m-Y',strtotime($value['createdDate'])) ; ?></td>
        <td><?php echo $value['incidence_addressed_internal'] ?></td>
        <td><?php echo $value['incidence_addressed_external'] ?></td>
        <td><?php echo $value['date_of_incidence_addressed'] ?></td>
        <td><?php echo $value['type_of_services'] ?></td>
        <td><?php echo $value['method_of_resolving'] ?></td>
        <td><?php echo $value['status'] ?></td>
        <td><?php echo $value['description']?></td>
        <td><?php echo $value['reason'] ?></td>
       
       
    </tr>
  
    <?php  } }?>

     <?php if($reportHistory){?>
        <?php  foreach($reportHistory as $value1) { ?>
    <tr >
          <td><?php echo date('d-m-Y',strtotime($value1['createdDate'])) ; ?></td>
        <td><?php echo $value1['incidence_addressed_internal'] ?></td>
        <td><?php echo $value1['incidence_addressed_external'] ?></td>
        <td><?php echo $value1['date_of_incidence_addressed'] ?></td>
        <td><?php echo $value1['type_of_services'] ?></td>
        <td><?php echo $value1['method_of_resolving'] ?></td>
        <td><?php echo $value1['status'] ?></td>
        <td><?php echo $value1['description']?></td>
        <td><?php echo $value1['reason'] ?></td>    
      
    </tr>
  
    <?php  } ?> 

   <?php }?> 
    
   </tbody> -->
 </table>
<?php //} ?>