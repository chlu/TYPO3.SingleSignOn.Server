<?php
namespace TYPO3\SingleSignOn\Server\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.SingleSignOn.Server".*
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
	 * @var \TYPO3\SingleSignOn\Server\Domain\Repository\SsoClientRepository
	 */
	protected $ssoClientRepository;

	/**
	 * Add a client
	 *
	 * @param string $identifier This argument is required
	 * @param string $publicKey The public key uuid (has to be imported using the wallet service first)
	 * @return void
	 */
	public function addCommand($identifier, $publicKey) {
		$ssoClient = new \TYPO3\SingleSignOn\Server\Domain\Model\SsoClient();
		$ssoClient->setIdentifier($identifier);
		$ssoClient->setPublicKey($publicKey);
		$this->ssoClientRepository->add($ssoClient);
	}

}

?>