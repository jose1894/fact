<?xml version="1.0" encoding="ISO-8859-1" standalone="no"?>
<Invoice
  xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2"
  xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
  xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
  xmlns:ccts="urn:un:unece:uncefact:documentation:2"
  xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
  xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
  xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2"
  xmlns:sac="urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1"
  xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
  <cbc:CustomizationID>1.0</cbc:CustomizationID>
  <!-- ///////////////////// Fecha de emision ///////////////////// -->
  <cbc:IssueDate><?= $model->fecha_doc ?></cbc:IssueDate>
  <!-- ///////////////////// Fecha de emision ///////////////////// -->
  <!-- ///////////////////// Certificado digital ///////////////////// -->
  <ext:UBLExtensions>
    <ext:UBLExtension>
      <ext:ExtensionContent>
        <ds:Signature Id="SignatureSP">
          <ds:SignedInfo>
            <ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
            <ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
            <ds:Reference URI="">
              <ds:Transforms><ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#envelopedsignature"/></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
              <ds:DigestValue><?= $model->hash_doc?></ds:DigestValue>
            </ds:Reference>
          </ds:SignedInfo>
          <?php
            $signedInfo = "<ds:SignedInfo>
              <ds:CanonicalizationMethod Algorithm=\"http://www.w3.org/2001/10/xml-exc-c14n#\"/>
              <ds:SignatureMethod Algorithm=\"http://www.w3.org/2001/04/xmldsig-more#rsa-sha256\"/>
              <ds:Reference URI=\"\">
                <ds:Transforms><ds:Transform Algorithm=\"http://www.w3.org/2000/09/xmldsig#envelopedsignature\"/></ds:Transforms><ds:DigestMethod Algorithm=\"http://www.w3.org/2001/04/xmldsig-more#rsa-sha256\"/>
                <ds:DigestValue><?= $model->hash_doc?></ds:DigestValue>
              </ds:Reference>
            </ds:SignedInfo>";

            $firma = base64_encode( hash( 'sha256', $signedInfo, false) );
          ?>
          <ds:SignatureValue><?= $firma?></ds:SignatureValue>
          <ds:KeyInfo>
            <ds:X509Data>
              <ds:X509SubjectName>C=PE,L = LIMA,O = CORPORACION LEOPHARD S.A.C.,OU = Validated by Llama.pe ER;OU = 20604954241,SERIALNUMBER = 09246916,CN = MARCILLA FELIX CIRIACO CARLOS,E = marvigcompany@gmail.com,STREET = JR. LAS ALCAPARRAS NRO. 467 URB. LAS FLORES</ds:X509SubjectName>
              <ds:X509Certificate>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
              ImLCz50FlOWnti0qaWZR8Q==</ds:X509Certificate>
            </ds:X509Data>
          </ds:KeyInfo>
        </ds:Signature>
      </ext:ExtensionContent>
    </ext:UBLExtension>
  </ext:UBLExtensions>
  <!-- ///////////////////// Certificado digital ///////////////////// -->
  <!-- ///////////////////// Firma Electronica ///////////////////// -->
  <cac:Signature>
    <cbc:ID>IDLeophardSIGN</cbc:ID>
    <cac:SignatoryParty>
      <cac:PartyIdentification>
        <cbc:ID><?= $empresa->ruc_empresa?></cbc:ID>
      </cac:PartyIdentification>
      <cac:PartyName>
        <cbc:Name>
          <![CDATA[<?= $empresa->nombre_empresa?>]]>
        </cbc:Name>
      </cac:PartyName>
    </cac:SignatoryParty>
  </cac:Signature>
  <!-- ///////////////////// Firma Electronica ///////////////////// -->
  <cac:AccountingSupplierParty>
    <!-- ///////////////////// RUC emisor ///////////////////// -->
    <cbc:CustomerAssignedAccountID><?= $empresa->ruc_empresa?></cbc:CustomerAssignedAccountID>
    <!-- ///////////////////// Tipo de documento emisor ///////////////////// -->
    <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
    <cac:Party>
      <cac:PartyName>
        <!-- ///////////////////// Razon social emisor ///////////////////// -->
        <cbc:Name>
          <![CDATA[<?= $empresa->nombre_empresa?>]]>
        </cbc:Name>
      </cac:PartyName>
      <cac:PostalAddress>
        <!-- ///////////////////// Ubigeo emisor ///////////////////// -->
        <cbc:ID>150132</cbc:ID>
        <!-- ///////////////////// Direccion emisor ///////////////////// -->
        <cbc:StreetName>JR. LAS ALCAPARRAS NRO. 467 URB. LAS FLORES - LIMA LIMA SAN JUAN DE LURIGANCHO</cbc:StreetName>
        <cbc:CitySubdivisionName></cbc:CitySubdivisionName>
        <!-- ///////////////////// Departamento emisor ///////////////////// -->
        <cbc:CityName>Lima</cbc:CityName>
        <!-- ///////////////////// Provincia emisor ///////////////////// -->
        <cbc:CountrySubentity>Lima</cbc:CountrySubentity>
        <!-- ///////////////////// Dsitrito emisor ///////////////////// -->
        <cbc:District>San Juan de Lurigancho</cbc:District>
        <cac:Country>
          <!-- ///////////////////// Codigo pais emisor ///////////////////// -->
          <cbc:IdentificationCode>PE</cbc:IdentificationCode>
        </cac:Country>
      </cac:PostalAddress>
      <cac:PartyLegalEntity>
        <cbc:RegistrationName>
          <!-- ///////////////////// Nomnbre comercial emisor ///////////////////// -->
          <![CDATA[CORPORACION LEOPHARD S.A.C.]]>
        </cbc:RegistrationName>
      </cac:PartyLegalEntity>
    </cac:Party>
  </cac:AccountingSupplierParty>
  <!-- ///////////////////// Tipo de documento ///////////////////// -->
  <cbc:InvoiceTypeCode>01</cbc:InvoiceTypeCode>
  <!-- ///////////////////// Numero de factura (Serie-Correlativo)///////////////////// -->
  <cbc:ID><?= $model->tipoDoc->abrv_tipod . $model->numeracion->serie_num .'-'.substr($modelDocumento->guiaRem->cod_doc,-8)?></cbc:ID>
  <cac:AccountingCustomerParty>
    <!-- ///////////////////// Ruc usuario ///////////////////// -->
    <cbc:CustomerAssignedAccountID><?= $model->pedidoDoc->cltePedido->ruc_clte?></cbc:CustomerAssignedAccountID>
    <!-- ///////////////////// Tipo de documento usuario ///////////////////// -->
    <cbc:AdditionalAccountID><?= $model->pedidoDoc->cltePedido->tipoid_clte?></cbc:AdditionalAccountID>
    <cac:Party>
      <cac:PartyLegalEntity>
        <cbc:RegistrationName>
          <!-- ///////////////////// Razon social usuario ///////////////////// -->
          <![CDATA[<?= $model->pedidoDoc->cltePedido->nombre_clte?>]]>
        </cbc:RegistrationName>
      </cac:PartyLegalEntity>
    </cac:Party>
  </cac:AccountingCustomerParty>
  <?php
    $total = 0;
    foreach ($model->pedidoDoc->pedidoDetalle as $key => $value) {
  ?>

  <cac:InvoiceLine>
    <!-- ///////////////////// Nro de orden de item ///////////////////// -->
    <cbc:ID><?= $key + 1?></cbc:ID>
    <!-- ///////////////////// Cantidad con unidad de medida de item ///////////////////// -->
    <cbc:InvoicedQuantity unitCode="<?= $model->pedidoDoc->pedidoDetalle->productoPdetalle->umedProd->sunatm_und?>"><?= $model->pedidoDoc->pedidoDetalle->cant_pdetalle?></cbc:InvoicedQuantity>
    <!-- ///////////////////// Precio unitario de item sin IGV y sin descuento por item ///////////////////// -->
    <cac:Price><?php
        $ivg = $model->pedidoDoc->pedidoDetalle->impuesto_pdetalle / 100;
        $precioUnitario = ($model->pedidoDoc->pedidoDetalle->precio_pdetalle /( 1 + $igv));
     ?><cbc:PriceAmount currencyID="<?= $model->pedidoDoc->monedaPedido->sunatm_moneda?>"><?= $precioUnitario?></cbc:PriceAmount>
    </cac:Price>
    <cac:Item>
      <!-- ///////////////////// Codigo de item ///////////////////// -->
      <cac:SellersItemIdentification>
        <cbc:ID><?= $model->pedidoDoc->pedidoDetalle->productoPdetalle->cod_prod?></cbc:ID>
      </cac:SellersItemIdentification>
      <!-- ///////////////////// Descripcion por item ///////////////////// -->
      <cbc:Description>
        <![CDATA[<?= $model->pedidoDoc->pedidoDetalle->productoPdetalle->des_prod?>]]>
      </cbc:Description>
    </cac:Item>
    <cac:PricingReference>
      <cac:AlternativeConditionPrice>
        <!-- ///////////////////// Precio unitario con IGV por item (tipo de moneda) ///////////////////// -->
        <cbc:PriceAmount currencyID="<?= $model->pedidoDoc->monedaPedido->sunatm_moneda?>"><?= $model->pedidoDoc->pedidoDetalle->productoPdetalle->precio_pdetalle?></cbc:PriceAmount>
        <!-- ///////////////////// Tipo de IGV por item ///////////////////// -->
        <cbc:PriceTypeCode>01</cbc:PriceTypeCode>
      </cac:AlternativeConditionPrice>
    </cac:PricingReference>
    <cac:TaxTotal>
      <!-- ///////////////////// Total de IGV por item ///////////////////// -->
      <cbc:TaxAmount currencyID="<?= $model->pedidoDoc->monedaPedido->sunatm_moneda?>"><?= $precioUnitario * $igv?></cbc:TaxAmount>
      <cac:TaxSubtotal>
        <!-- ///////////////////// Total de IGV por item ///////////////////// -->
        <cbc:TaxAmount currencyID="<?= $model->pedidoDoc->monedaPedido->sunatm_moneda?>"><?= $precioUnitario * $igv?></cbc:TaxAmount>
        <cac:TaxCategory>
          <cbc:TaxExemptionReasonCode>10</cbc:TaxExemptionReasonCode>
          <cac:TaxScheme>
            <cbc:ID>1000</cbc:ID>
            <cbc:Name>IGV</cbc:Name>
            <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
          </cac:TaxScheme>
        </cac:TaxCategory>
      </cac:TaxSubtotal>
    </cac:TaxTotal>
    <!-- ///////////////////// Total de Precio unitario por item menos el descuento sin IGV por item ///////////////////// -->
    <cbc:LineExtensionAmount currencyID="<?= $model->pedidoDoc->monedaPedido->sunatm_moneda?>"><?= $precioUnitario * $model->pedidoDoc->pedidoDetalle->cant_pdetalle?></cbc:LineExtensionAmount>
  </cac:InvoiceLine>
  <?php
      $total += $model->pedidoDoc->pedidoDetalle->total_pdetalle;
    }
    $subtotal = $total / ( 1 + $igv);
    ?>
  <ext:UBLExtension>
    <ext:ExtensionContent>
      <sac:AdditionalInformation>
        <!-- ///////////////////// Total de valor de ventas sin IGV ///////////////////// -->
        <sac:AdditionalMonetaryTotal>
          <cbc:ID>1001</cbc:ID>
          <cbc:PayableAmount currencyID="<?= $model->pedidoDoc->monedaPedido->sunatm_moneda?>"><?= $subtotal ?></cbc:PayableAmount>
        </sac:AdditionalMonetaryTotal>
      </sac:AdditionalInformation>
      <sac:AdditionalInformation>
        <sac:AdditionalProperty>
          <cbc:ID>1000</cbc:ID>
          <cbc:Value>Son Catorce mil quinientos ocho y 00/100</cbc:Value>
        </sac:AdditionalProperty>
      </sac:AdditionalInformation>
    </ext:ExtensionContent>
  </ext:UBLExtension>
  <cac:TaxTotal>
    <cbc:TaxAmount currencyID="PEN">59210.65</cbc:TaxAmount>
    <cac:TaxSubtotal>
      <cbc:TaxAmount currencyID="PEN">59210.65</cbc:TaxAmount>
      <cac:TaxCategory>
        <cac:TaxScheme>
          <cbc:ID>1000</cbc:ID>
          <cbc:Name>IGV</cbc:Name>
          <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
        </cac:TaxScheme>
      </cac:TaxCategory>
    </cac:TaxSubtotal>
  </cac:TaxTotal>
  <cac:LegalMonetaryTotal>
    <cbc:PayableAmount currencyID="PEN">45.34</cbc:PayableAmount>
  </cac:LegalMonetaryTotal>
  <cbc:DocumentCurrencyCode>PEN</cbc:DocumentCurrencyCode>
</Invoice>
