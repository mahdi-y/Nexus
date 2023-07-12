<?php

declare(strict_types=1);

namespace App\Controller;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Margin\Margin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface as GoogleAuthenticatorTwoFactorInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class QrCodeController extends AbstractController
{
    #[Route('/members/qr/ga', name: 'qr_code_ga')]
    public function displayGoogleAuthenticatorQrCode(TokenStorageInterface $tokenStorage, GoogleAuthenticatorInterface $googleAuthenticator): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        if (!($user instanceof GoogleAuthenticatorTwoFactorInterface)) {
            throw new NotFoundHttpException('Cannot display QR code');
        }

        return $this->displayQrCode($googleAuthenticator->getQRContent($user));
    }

    private function displayQrCode(string $qrCodeContent): Response
    {
        $result = new QrCode('Life is too short to be generating QR codes');
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($qrCodeContent)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(200)
            ->margin(0)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();

        return new Response($result->getString(), 200, ['Content-Type' => 'image/png']);
    }
}
