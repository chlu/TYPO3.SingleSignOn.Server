<?php
namespace Flowpack\SingleSignOn\Server\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Flowpack.SingleSignOn.Server".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Command controller to manage SSO Clients
 *
 * @Flow\Scope("singleton")
 */
class ClientCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \Flowpack\SingleSignOn\Server\Domain\Repository\SsoClientRepository
	 */
	protected $ssoClientRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Cryptography\RsaWalletServiceInterface
	 */
	protected $rsaWalletService;

	/**
	 * Add a client
	 *
	 * @param string $baseUri The client base URI as the client identifier
	 * @param string $publicKey The public key fingerprint (has to be imported using the RSA wallet service first)
	 * @return void
	 */
	public function addCommand($baseUri, $publicKey) {
		try {
			$this->rsaWalletService->getPublicKey($publicKey);
		} catch(\TYPO3\Flow\Security\Exception\InvalidKeyPairIdException $exception) {
			$this->outputLine('Invalid public key uuid: ' . $publicKey);
		}

		$ssoClient = new \Flowpack\SingleSignOn\Server\Domain\Model\SsoClient();
		$ssoClient->setServiceBaseUri($baseUri);
		$ssoClient->setPublicKey($publicKey);
		$this->ssoClientRepository->add($ssoClient);
	}

}

?>