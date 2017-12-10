<?php

namespace Mautic\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $packageType = $package->getType();
        $packageName = $package->getPrettyName();

        switch (true) {
            case strpos($packageType, 'mautic-theme') === 0:
                $this->vendorDir = 'themes/vendor';
                return 'themes/'.basename($packageName);
                break;
            case strpos($packageType, 'mautic/plugin-') === 0:
                $this->vendorDir = 'plugins/vendor';
                return 'plugins/'.basename($packageName);
                break;
            default:
                throw new \InvalidArgumentException(
                    'Unable to install. '
                );

        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        $supportedTypes = [
            'mautic-plugin',
            'mautic-theme',
        ];

        return in_array($packageType, $supportedTypes);
    }
}