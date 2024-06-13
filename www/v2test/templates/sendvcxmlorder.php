<?php

$query="select vc_surname,vc_postcode,vc_cli,vc_street,vc_city,vc_cbuk,btproduct_id,userbw_id,usercr_id,vc_orderdate,vc_reqdeliverydate,vc_productiondate,vc_state,vc_vci,vp_id,vcfault_id,vc_id from dslprov_vc where (vc_state>21 and vc_state<26) or vc_state>30";
$result=MYSQL_QUERY($query);
$noofentries=MYSQl_NUM_ROWS($result);

$timestamp=time();
$file="/var/www/crm/mwerkcrm/orders/eco.$timestamp";
$fhandler=fopen($file, "x+");

$output="
<?xml version=\"1.0\" encoding=\"UTF-8\"?><?soxtype urn:x-commerceone:document:btsox:Batch.sox$1.0?><?import urn:x-commerceone:document:telcoapis
ox:ServiceRequestOrder.sox$1.0?>
<?import urn:x-commerceone:document:com:commerceone:CBL:CBL.sox$1.0?>
<?import urn:x-commerceone:document:btsox:DSL.sox$1.0?>
<bat:Batch BatchID = \"$batch_id\" NoOfEntries=\"$noofentries\"
    xmlns=\"urn:x-commerceone:document:com:commerceone:CBL:CBL.sox$1.0\"
    xmlns:bat=\"urn:x-commerceone:document:btsox:Batch.sox$1.0\"
    xmlns:sro=\"urn:x-commerceone:document:telcoapisox:ServiceRequestOrder.sox$1.0\"
    xmlns:dsl=\"urn:x-commerceone:document:btsox:DSL.sox$1.0\">

";

//echo (htmlspecialchars($output));
fwrite ($fhandler,$output);

$POIssuedDate=date("Ymd\TH:i:s",time());
$rdd=time()+432000;
$RequestedDeliveryDate=("Ymd\TH:i:s");
$AccountCode="12345678AC01";
$BuyerRefNum="200100002345";
$Ident="O/M999999999";
$OrderContactName="Bloggs";
$OrderContactTelephone="02089999999";
$OrderContactTitle="Mr";
$OrderContactFirstName="Joe";
$OrderContactInitials="JS";
$ItemType="Provision";




while ($line=MYSQL_FETCH_ASSOC($result)) {
	//var_dump($line);
	$LineItemNum++;
	// FIXME map the product_id to product_value
	$PartID=$line[btproduct_id];
	// FIXME get proper values from db
	$btpop_gbno="GB/NW19JA/BCK";
	$btpop_ContactName="Smith";
	$btpop_Telephone="02089999999";
	$btpop_Title="Mr";
	$btpop_FirstName="John";
	$btpop_Initials="M";
	// OK
	$vc_id=$line[vc_id];
	$vc_premisesname=$line[vc_premisesname];
	$vc_street=$line[vc_street];
	$vc_city=$line[vc_city];
	$vc_postcode=$line[vc_postcode];
	
	$vc_surname=$line[vc_surname];
	$vc_contactphone=$line[vc_contactphone];
	$vc_title=$line[vc_title];
	$vc_firstname=$line[vc_firstname];
	$vc_initials=$line[vc_initials];

	$vc_carelevel=$line[vc_carelevel];
	$vp_dsuk=$line[vp_dsuk];
	$vc_cli=$line[vc_cli];
	$vc_reqdeliverydate=$line[vc_reqdeliverydate];
	if ($vc_reqdeliverydate=='') {
		get_leadtimes($vc_leadtime,$vp_leadtime);
		$vc_reqdeliverydate=$timestamp+$vc_leadtime;
	}
	$vc_state=$line[vc_state];
	$output="
	  <PurchaseOrder>
	   <OrderHeader>
	    <POIssuedDate>$POIssuedDate</POIssuedDate>
	     <RequestedDeliveryDate>$RequestedDeliveryDate</RequestedDeliveryDate>
	      <OrderReference>
	        <AccountCode>
	          <Reference>
	            <RefNum>$AccountCode</RefNum>
	          </Reference>
	        </AccountCode>
	        <BuyerRefNum>
	          <Reference>
	            <RefNum>$BuyerRefNum</RefNum>
	          </Reference>
	        </BuyerRefNum>
	      </OrderReference>
	      <OrderParty>
	        <BuyerParty>
	          <Party>
	            <ListOfIdentifier>
	              <Identifier>
	                <Agency/>
	                <Ident>$Ident</Ident>
	              </Identifier>
	            </ListOfIdentifier>
	            <OrderContact>
	              <sro:DetailedContact>
	                <ContactName>$OrderContactName</ContactName>
	                <Telephone>$OrderContactTelephone</Telephone>
	                <sro:Title>$OrderContactTitle</sro:Title>
	                <sro:FirstName>$OrderContactFirstName</sro:FirstName>
	                <sro:Initials>$OrderContactInitials</sro:Initials>
	              </sro:DetailedContact>
	            </OrderContact>
	          </Party>
	        </BuyerParty>
	        <SupplierParty>
	          <Party>
	            <ListOfIdentifier>
	              <Identifier>
	                <Agency/>
	                <Ident>BT</Ident>
	              </Identifier>
	            </ListOfIdentifier>				
	          </Party>
	        </SupplierParty>
	      </OrderParty>
	      <OrderCurrency>GBP</OrderCurrency>
	      <OrderLanguage>en</OrderLanguage>
	      <PartialShipmentAllowed>false</PartialShipmentAllowed>
	</OrderHeader>
	<ListOfOrderDetail>
	<OrderDetail>
	<sro:ServiceRequestOrder ItemType=\"$ItemType\">
	  <LineItemNum>$LineItemNum</LineItemNum>
	  <SupplierPartNum>
	    <PartNum>
	      <Agency/>
	      <PartID>$PartID</PartID>
            </PartNum>
	  </SupplierPartNum>
	  <Quantity>
	    <Qty>1</Qty>
	    <UnitOfMeasure>
	      <UOM>EA</UOM>
	    </UnitOfMeasure>
	  </Quantity>
	  <sro:Site End=\"A\">
	    <sro:Id>$btpop_gbno</sro:Id>
	    <sro:DetailedContact>
	      <ContactName>$btpop_ContactName</ContactName>
	      <Telephone>$btpop_Telephone</Telephone>
	      <sro:Title>$btpop_Title</sro:Title>
	      <sro:FirstName>$btpop_FirstName</sro:FirstName>
	      <sro:Initials>$btpop_Initials</sro:Initials>
	    </sro:DetailedContact>
	  </sro:Site>
	  <sro:Site End=\"B\">
	    <sro:Address>
	      <sro:BritishAddress>
		<sro:PremisesName>$vc_premisesname</sro:PremisesName>
		<sro:ThoroughfareName>$vc_street</sro:ThoroughfareName>
		<sro:PostTown>$vc_city</sro:PostTown>
		<sro:PostCode>$vc_postcode</sro:PostCode>
	      </sro:BritishAddress>
	    </sro:Address>
	    <sro:DetailedContact>
	      <ContactName>$vc_surname</ContactName>
	      <Telephone>$vc_contactphone</Telephone>
	      <sro:Title>$vc_title</sro:Title>
	      <sro:FirstName>$vc_firstname</sro:FirstName>
	      <sro:Initials>$vc_initials</sro:Initials>
	    </sro:DetailedContact>
	  </sro:Site>
	  <sro:Features>
	    <dsl:FeatureSet>	
	      <dsl:Provision>
		<dsl:ProvisionGeneral CareLevel=\"$vc_carelevel\" />
		<dsl:ProvisionAEnd SPNominatedVP=\"$vp_dsuk\" />
		<dsl:ProvisionBEnd>				
		  <dsl:NTE CheckAlarmAfterInstall=\"Y\">
		    <dsl:TelephoneNumber>$vc_cli</dsl:TelephoneNumber>
		  </dsl:NTE>
		</dsl:ProvisionBEnd>
	      </dsl:Provision>
	    </dsl:FeatureSet>
	  </sro:Features>
	</sro:ServiceRequestOrder>
	<RequestedDeliveryDate>$vc_reqdeliverydate</RequestedDeliveryDate>
	<BuyerExpectedUnitPrice>
	  <Price>
	    <UnitPrice>0</UnitPrice>
	  </Price>
	</BuyerExpectedUnitPrice>
	</OrderDetail>
	</ListOfOrderDetail>
	<OrderSummary><TotalAmount>0</TotalAmount></OrderSummary>
	</PurchaseOrder>	
	";
	//echo (htmlspecialchars($output));
	fwrite ($fhandler,$output);
	
	//simulate different feedbacks
	if ($vc_state!=31) {
		$answer=rand(1,100);
		if ($answer<=20) {
			echo("
			<p>$vc_cli incompatible Product</p>
			");
			// INCOMPATIBLE PRODUCT
			$vc_state=6;
			$btuserorderstate=3;
			$vc_orderdate=$timestamp;
			$vc_productiondate='';
			$vc_statechangedate=$timestamp;
			$vcfault_id=1;
		}
		else if ($answer<=40) {
			echo("
			<p>$vc_cli Line Loss</p>
			");
			// LINE LOSS
			$vc_state=5;
			$btuserorderstate=3;
			$vc_orderdate=$timestamp;
			$vc_productiondate='';
			$vc_statechangedate=$timestamp;
			$vcfault_id=2;
		}
		else {
			echo("
			<p>$vc_id $vc_cli set to productive</p>
			");
			//everything OK set vc to productive
			$vc_state=27;
			
			$cbuk=rand(100,999);
			$vc_cbuk="CBUK900$cbuk";
			$btuserorderstate=1;
			$vc_orderdate=$timestamp;
			$vc_productiondate=$timestamp;
			$vc_statechangedate=$timestamp;
			$vcfault_id='';
		}
	} else {
		$vc_state=9;
		$vc_cbuk='';
		$vc_orderdate='';
		$vc_productiondate='';
		$vc_statechangedate=$timestamp;
		$vc_reqdeliverydate='';
		$vcfault_id='';
		$btuserorderstate=1;
	}

	$changes[$LineItemNum]= array ("vc_id" => $vc_id, "vc_state" => $vc_state, "vc_cbuk" => $vc_cbuk, "btuserorderstate_id" => $btuserorderstate, "vc_orderdate" => $vc_orderdate, "vc_productiondate" => $vc_productiondate, "vc_statechangedate" => $vc_statechangedate, "vc_reqdeliverydate" => $vc_reqdeliverydate, "vcfault_id" => $vcfault_id);
/*	$result=mysql_query("UPDATE dslprov_vc SET vc_state='$vc_state',vc_cbuk = '$vc_cbuk',btuserorderstate_id='$btuserorderstate',vc_orderdate='$vc_orderdate',vc_productiondate='$vc_productiondate',vc_statechangedate='$vc_statechangedate' WHERE vc_id='$vc_id'");
	if ($result==1) {
		echo("
		<p>$vc_id set to productive</p>
		");
	}
	else {
		echo("
		<p>$vc_id setting is not possible</p>
		");
	};
	add_vchistory($vc_id);
*/
}

foreach ($changes as $key => $value) {
	$vc_id=$changes[$key]["vc_id"];
	$vc_state=$changes[$key]["vc_state"];
	$vc_cbuk=$changes[$key]["vc_cbuk"];
	$btuserorderstate=$changes[$key]["btuserorderstate"];
	$vc_orderdate=$changes[$key]["vc_orderdate"];
	$vc_productiondate=$changes[$key]["vc_productiondate"];
	$vc_reqdeliverydatedate=$changes[$key]["vc_reqdeliverydate"];
	$vc_statechangedate=$changes[$key]["vc_statechangedate"];
	$vcfault_id=$changes[$key]["vcfault_id"];
	$result=mysql_query("UPDATE dslprov_vc SET vc_state='$vc_state',vc_cbuk = '$vc_cbuk',btuserorderstate_id='$btuserorderstate',vc_orderdate='$vc_orderdate',vc_productiondate='$vc_productiondate',vc_statechangedate='$vc_statechangedate',vc_reqdeliverydate='$vc_reqdeliverydate',vcfault_id='$vcfault_id' WHERE vc_id='$vc_id'");
	
	add_vchistory($vc_id);
}
$output="</bat:Batch>";
fwrite ($fhandler,$output);
fclose($fhandler);

echo("
<iframe width=640 height=480 frameborder=0 scrolling=yes src=\"orders/eco.$timestamp\">
");
echo("
<p>Order has been placed.</p>
");
echo("
</iframe>
");

?>
