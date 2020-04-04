<?php

declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200403145333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create configuration';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `weather_provider` (`id`, `key`,`name`, `config`) VALUES
 ('1', 'openweather', 'OpenWeather', '{\"url\":\"http://api.openweathermap.org/data/2.5/weather\",\"apiKey\":\"dbc8a3b2bbb8a734934f22849041310f\"}');");
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE `wp` FROM `weather_provider` `wp` WHERE `wp`.`id`=1;');
    }
}
