<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.autentique.com.br/v2/graphql',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('operations' => '{"query":"mutation CreateDocumentMutation($document: DocumentInput!, $signers: [SignerInput!]!,$file: Upload!) {createDocument(sandbox:true,document: $document, signers: $signers, file: $file) {id name refusable sortable created_at signatures { public_id name email created_at action { name } link { short_link } user { id name email }}}}", "variables":{"document": {"name": "Contrato de teste"},"signers": [{"email": "troque-esse-email-que-e-publico@tuamaeaquelaursa.com","action": "SIGN"}]}}','map' => '{"file": ["variables.file"]}','file'=> new CURLFILE('/C:/Users/Glauco/Desktop/Proposta Nr 240153.pdf')),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 5f2e67bcc605c25a213b716e0aba3bae6f73e76cf3f6cfb6c44529337b2265b2'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
