<?php
?>
<script src="https://cdn.ethers.io/lib/ethers-5.0.umd.min.js" type="text/javascript">
</script>

<div>
<span class=infoNetwork></span>
</div>
<hr>
<button class="enableEthereumButton">Enable Ethereum</button>
<h2>Account: <span class="showAccount"></span></h2>
<h2>Balance: <span class="showBalance"></span></h2>
<h2>ChainID: <span class="showChain"></span></h2>
<!-- <h2>Account: <span class="showAccount2"></span></h2>-->

<button class="butBuyWoolf">Buy Woolf</button>

<script>

document.querySelector('.infoNetwork').innerHTML = 'Wait...';

var metamask_enable = 1;

if (typeof window.ethereum !== 'undefined') 
{
  console.log('MetaMask is installed!');
}
else
{
  document.querySelector('.infoNetwork').innerHTML = 'Metamask not installed. If you need Metamask Functions - Go to <a href=https://metamask.io/ target=_blank>https://metamask.io/</a>';
  metamask_enable = 0;
}


if(metamask_enable)
{
const provider = new ethers.providers.Web3Provider(window.ethereum);
//console.log(provider);
const signer = provider.getSigner()
//console.log(signer);

getBlock();
async function getBlock()
{
	blk = await provider.getBlockNumber();
	console.log("BLK: "+blk);
}
async function getBalance(addr)
{
	balance = await provider.getBalance(addr);
	balance = ethers.utils.formatEther(balance);
	console.log(balance);
	document.querySelector('.showBalance').innerHTML = balance;
}

const contractPointer = '0x9957fA229f17F6aEc4C66bdF8425B8538c9882B6';


const abiPointer = [
  // Some details about the token
	"function FindByName(string memory name) view returns(address)"
];
const abiWoolf = [
	"function mint(uint256 amount, bool stake)"
]
const cPointer = new ethers.Contract(contractPointer, abiPointer, provider);
async function get_contract_addr(whats)
{
const contract = await cPointer.FindByName(whats);
//console.log(contractBarn.values(PromiseResult));
console.log("Addr "+whats+": "+contract);
return contract;
}

const contractBarn	= get_contract_addr("barn");
const contractWool	= get_contract_addr("wool");
const contractWoolf	= get_contract_addr("woolf");

function tx_woolf_mint()
{
//	butBuyWoolf
}

const ethereumButton = document.querySelector('.enableEthereumButton');
const showAccount = document.querySelector('.showAccount');
//const showAccount2 = document.querySelector('.showAccount2');


getAccount();
getChainId();

ethereumButton.addEventListener('click', () => {
  getAccount();
});

document.querySelector('.butBuyWoolf').addEventListener('click', () => {
  
});

//var accounts;
//var account;
async function getAccount() {
  accounts = await ethereum.request({ method: 'eth_requestAccounts' });
  account = accounts[0];
  showAccount.innerHTML = account;

  if(account != undefined)
  getBalance(account);

//  const account2 = accounts[1];
//  showAccount2.innerHTML = account2;
}
async function getChainId()
{
	chainId = await ethereum.request({ method: 'eth_chainId' });
	onChainChange(chainId);
}
async function getGasPrice()
{
//	gazz = await ethereum.request({ method: 'eth_gasPrice' });
	gazz = await provider.getGasPrice();
	console.log('GAS '+gazz);;
}
getGasPrice();
ethereum.on('accountsChanged', function (accounts) {
//  accounts = await ethereum.request({ method: 'eth_requestAccounts' });
  account = accounts[0];
  showAccount.innerHTML = account;
  if(account != undefined)
  getBalance(account);

  // Time to reload your interface with accounts[0]!
});


ethereum.on('chainChanged', (chainId) => {
  // Handle the new chain.
  // Correctly handling chain changes can be complicated.
  // We recommend reloading the page unless you have good reason not to.
//  window.location.reload();
	onChainChange(chainId);
});
function onChainChange(chainId)
{
  document.querySelector('.showChain').innerHTML = chainId;
}


}
//interface ConnectInfo {
//  chainId: string;
//}

//ethereum.on('connect', handler: (connectInfo: ConnectInfo) => void);

</script>

