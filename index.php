<?php
  require_once __DIR__ . '/vendor/autoload.php';
  use ETH\Monitor;

  $monitor = new Monitor([
    'node' => 'https://ropsten.infura.io',
    'network' => $_GET['network'] ? $_GET['network'] : 'ropsten',
    'blockConfirm' => $_GET['blockConfirm'] ? $_GET['blockConfirm'] : 7,
    'txLostTimeout' => $_GET['timeout'] ? $_GET['timeout'] : 15, // minutes
    'intervalRefetchTx' => 10, // seconds
    'checkPaymentValid' => true,
    'receivedAddress' => $_GET['receivedAddress'] ? $_GET['receivedAddress'] : '0xb2d904d1981080C9002818D833819e33a58F8388',
    'amount' => $_GET['amount'] ? $_GET['amount'] : 6,
    'receivedToken' => $_GET['receivedToken'] ? $_GET['receivedToken'] : "KNC",
    'useIntervalLoop' => $_GET['useIntervalLoop'] == 'on' ? true : false,
  ]);
  
  // swap
  $tx = '0xe763ffe95d02e231f1d7450a0848b588447c8bf604953077fefc1eef369e901e';
  $tx = '0xdabc1ab1e8333125fbaa5d36a479e9ee6cefa59b49df4dad70d255344c250055';
  // transfer Token
  $tx = '0xd910078d3c2630acfdf15c0f72b09d0808639fcc5323ea6fe054e9444f90525d';
  // transfer ETH
  $tx = '0x253f8e00104738fca9869010ebf78218ae4d2c40be4d48d0b85b13a8971b4cb6';

  // Pay Token -> ETH
  $tx = '0xf513db1b7de61ba88afecd5a9a228c983b5b0b6b48bbb56f859bcd60dafc245d';
  $tx = '0x8f27370da1b79ffe3d6205ba21cc21cc09ebb80dd2a7c56800f367cc103dcebf';
  // Pay ETH -> ETH
  $tx = '0xc2a66fd9238d609b3428946f990cc64cd9aa6f34baebf336b4916fabfed9e1a6';
  // Pay ETH -> Token
  $tx = '0x5388158e57fecefd3a850283f606ab58e4670c29f730f470ab7f413551c01af4';
  // Pay Token -> Token
  $tx = '0x5aa30da4ed81079b8136801ee4ab1e712a73f9c1df8949236fcd8d6f0b988b62';

  $_GET['tx'] = $tx;

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container-fluid mt-5">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-4">
            <h4>Settings</h4>
            <form>
              <div class="form-group">
                <label>Network</label>
                <select name="network" id="" class="form-control">
                  <option value="ropsten">Ropsten</option>
                  <option value="mainnet" <?= $_GET['network'] == 'mainnet' ? 'selected' : ''?> >Mainnet</option>
                </select>
              </div>
              <div class="form-group">
                <label>Transaction hash</label>
                <input type="text" name="tx" class="form-control" value="<?= $_GET['tx'] ?>">
              </div>
              <div class="form-group">
                <label>Block confirm 
                  <small>(default: 7)</small>
                </label>
                <input type="text" name="blockConfirm" class="form-control" value="<?= $_GET['blockConfirm'] ?>">
              </div>
              <div class="form-group">
                <label>Tx lost timeout 
                  <small>(minutes, default: 15)</small>
                </label>
                <input type="text" name="timeout" class="form-control" value="<?= $_GET['timeout'] ?>">
              </div>
              <div class="form-group">
                <label>Receive address</label>
                <input type="text" name="receivedAddress" class="form-control" value="<?= $_GET['receivedAddress'] ?>">
              </div>
              <div class="form-group">
                <label>Amount</label>
                <input type="text" name="amount" class="form-control" value="<?= $_GET['amount'] ?>">
              </div>
              <div class="form-group">
                <label>Received Token</label>
                <input type="text" name="receivedToken" class="form-control" value="<?= $_GET['receivedToken'] ?>">
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="useIntervalLoop" <?= $_GET['useIntervalLoop'] == 'on' ? 'checked' : '' ?> id="useIntervalLoop">
                <label class="form-check-label" for="useIntervalLoop">Use interval loop?</label>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
          <div class="col-sm-8 ml-auto">
            <pre><?php var_dump($monitor->checkStatus($tx)); ?></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>