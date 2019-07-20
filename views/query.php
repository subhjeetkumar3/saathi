SELECT t1.fingerDate,t2.stateName,t3.`districtName`,
a.arg1,a.arg2,a.arg3,a.arg4,a.arg5,a.arg6,a.arg7,
(COUNT(a.arg1) + COUNT(a.arg2) + COUNT(a.arg3) + COUNT(a.arg4) + COUNT(a.arg5) + COUNT(a.arg6)
 + COUNT(a.arg7))AtotalScreeningArg,
a.arg8,a.arg9,a.arg10,a.arg11,a.arg12,(COUNT(a.arg9) + COUNT(a.arg10) + COUNT(a.arg11) + COUNT(a.arg12))AtotalScreeningHrg,
(COUNT(a.arg1) + COUNT(a.arg2) + COUNT(a.arg3) + COUNT(a.arg4) + COUNT(a.arg6) + COUNT(a.arg7) + COUNT(a.arg9) + 
COUNT(a.arg10) + COUNT(a.arg11) + COUNT(a.arg12))ASum,
b.arg13,b.arg14,b.arg15,b.arg16,b.arg17,b.arg18,
b.arg19,(COUNT(b.arg13) + COUNT(b.arg14) + COUNT(b.arg15) + COUNT(b.arg16) + 
COUNT(b.arg17) + COUNT(b.arg18) + COUNT(b.arg19))BtotalScreeningArg,
b.arg20,b.arg21,b.arg22,b.arg23,b.arg24,(COUNT(b.arg21) + COUNT(b.arg22) + COUNT(b.arg23) + COUNT(b.arg24))BtotalScreeningHrg,
(COUNT(b.arg13) + COUNT(b.arg14) + COUNT(b.arg15) + COUNT(b.arg16) + COUNT(b.arg17) + COUNT(b.arg18) + COUNT(b.arg19) + 
COUNT(b.arg21) + COUNT(b.arg22) + COUNT(b.arg23) + COUNT(b.arg24))BSum,
c.arg25,c.arg26,c.arg27,c.arg28,
c.arg29,c.arg30,c.arg31,(COUNT(c.arg25) + COUNT(c.arg26) + COUNT(c.arg27) + COUNT(c.arg28) + COUNT(c.arg29) + COUNT(c.arg30) + COUNT(c.arg31))CtotalScreeningArg,
c.arg32,c.arg33,c.arg34,c.arg35,c.arg36,
(COUNT(c.arg33) + COUNT(c.arg34) + COUNT(c.arg35) + COUNT(c.arg36))CtotalScreeningHrg,
(COUNT(c.arg25) + COUNT(c.arg26) + COUNT(c.arg27) + COUNT(c.arg28) + COUNT(c.arg29) + COUNT(c.arg30) + COUNT(c.arg31) + 
COUNT(c.arg33) + COUNT(c.arg34) + COUNT(c.arg35) + COUNT(c.arg36))CSum,
d.arg37,d.arg38,d.arg39,d.arg40,d.arg41,
d.arg42,d.arg43,(COUNT(d.arg37) + COUNT(d.arg38) + COUNT(d.arg39) + COUNT(d.arg40) + COUNT(d.arg41) + COUNT(d.arg42) + COUNT(d.arg43))DtotalScreeningArg,
d.arg44,d.arg45,d.arg46,d.arg47,d.arg48,(COUNT(d.arg45) + COUNT(d.arg46) + COUNT(d.arg47) + COUNT(d.arg48))DtotalScreeningHrg,
(COUNT(d.arg37) + COUNT(d.arg38) + COUNT(d.arg39) + COUNT(d.arg40) + COUNT(d.arg41) + COUNT(d.arg42) + COUNT(d.arg43) + 
COUNT(d.arg45) + COUNT(d.arg46) + COUNT(d.arg47) + COUNT(d.arg48))DSum,
e.arg49,e.arg50,e.arg51,e.arg52,e.arg53,e.arg54,e.arg55,(COUNT(e.arg49) + COUNT(e.arg50) + COUNT(e.arg51) + COUNT(e.arg52) + COUNT(e.arg53) + COUNT(e.arg54) + COUNT(e.arg55))EtotalScreeningArg,
e.arg56,e.arg57,e.arg58,e.arg59,e.arg60,(COUNT(e.arg57) + COUNT(e.arg58) + COUNT(e.arg59) + COUNT(e.arg60))EtotalScreeningHrg,
(COUNT(e.arg49) + COUNT(e.arg50) + COUNT(e.arg51) + COUNT(e.arg52) + COUNT(e.arg53) + COUNT(e.arg54) + COUNT(e.arg55) + 
COUNT(e.arg57) + COUNT(e.arg58) + COUNT(e.arg59) + COUNT(e.arg60) )ESum
 FROM (`tbl_user` AS t1) LEFT JOIN tbl_state AS t2 ON t1.addressState = t2.stateId LEFT JOIN `tbl_district` AS t3 ON t1.addressDistrict = t3.`districtId` 
LEFT JOIN (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg1,
CASE WHEN (occupation = "Migrant") THEN occupation END arg2, CASE WHEN (occupation = "Student") THEN occupation END arg3, 
CASE WHEN (occupation = "Daily Wage") THEN occupation END arg4, 
CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") THEN occupation END arg5, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg6, 
CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg7,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg8,
CASE WHEN hrg = "MSM" THEN hrg END arg9,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg10,CASE WHEN hrg = "FSW" THEN hrg END arg11,
CASE WHEN hrg = "IDU" THEN hrg END arg12  FROM `tbl_user`  WHERE fingerDate IS NOT NULL OR fingerDate != " ")a 
ON t1.userId = a.userId LEFT JOIN 
(SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg13, 
CASE WHEN (occupation = "Migrant") THEN occupation END arg14, CASE WHEN (occupation = "Student") THEN occupation END arg15, 
CASE WHEN (occupation = "Daily Wage") THEN occupation END arg16, 
CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") 
THEN occupation END arg17, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg18, 
CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg19,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg20,
CASE WHEN hrg = "MSM" THEN hrg END arg21,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg22,CASE WHEN hrg = "FSW" THEN hrg END arg23,
CASE WHEN hrg = "IDU" THEN hrg END arg24 FROM `tbl_user`  WHERE saictcStatus = "Yes")b ON t1.userId = b.userId
 LEFT JOIN (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg25, 
 CASE WHEN (occupation = "Migrant") THEN occupation END arg26, CASE WHEN (occupation = "Student") THEN occupation END arg27, 
 CASE WHEN (occupation = "Daily Wage") THEN occupation END arg28, CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") THEN occupation END arg29, 
 CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg30, 
 CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg31,
 CASE WHEN ARG = "TG (F-M)" THEN ARG END arg32,CASE WHEN hrg = "MSM" THEN hrg END arg33,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg34,
 CASE WHEN hrg = "FSW" THEN hrg END arg35,
 CASE WHEN hrg = "IDU" THEN hrg END arg36 FROM `tbl_user`  WHERE hivDate IS NOT NULL OR hivDate != " ")c ON t1.userId = c.userId 
 LEFT JOIN (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg37, 
 CASE WHEN (occupation = "Migrant") THEN occupation END arg38, CASE WHEN (occupation = "Student") THEN occupation END arg39, 
 CASE WHEN (occupation = "Daily Wage") THEN occupation END arg40, 
 CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") 
 THEN occupation END arg41, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg42, 
 CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg43,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg44,
 CASE WHEN hrg = "MSM" THEN hrg END arg45,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg46,
 CASE WHEN hrg = "FSW" THEN hrg END arg47,CASE WHEN hrg = "IDU" THEN hrg END arg48 FROM `tbl_user`  
 WHERE hivStatus = "Reactive" )d ON t1.userId = d.userId LEFT JOIN 
 (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg49, 
 CASE WHEN (occupation = "Migrant") THEN occupation END arg50, CASE 
 WHEN (occupation = "Student") THEN occupation END arg51, CASE WHEN (occupation = "Daily Wage") THEN occupation END arg52, 
 CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") 
 THEN occupation END arg53, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg54, 
 CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg55,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg56,
 CASE WHEN hrg = "MSM" THEN hrg END arg57,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg58,CASE WHEN hrg = "FSW" THEN hrg END arg59,
 CASE WHEN hrg = "IDU" THEN hrg END arg60 FROM `tbl_user` WHERE artDate IS NOT NULL OR artDate != " ") AS e 
 ON t1.userId = e.userId
WHERE `t1`.`deleted` = "N" AND t1.userType = "user" GROUP BY t1.userId