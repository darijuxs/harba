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
 ('1', 'openweather', 'OpenWeather', '{\"url\":\"http://api.openweathermap.org/data/2.5/weather\",\"apiKey\":\"dbc8a3b2bbb8a734934f22849041310f\"}'),
 ('2', 'yahoo', 'Yahoo', '{\"url\":\"https://weather-ydn-yql.media.yahoo.com/forecastrss\",\"appId\":\"zGa2F44c\",\"consumerKey\":\"dj0yJmk9bGJ5WEhURzhCRG13JmQ9WVdrOWVrZGhNa1kwTkdNbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTY1\",\"consumerSecret\":\"d84f9a04e8a78e0f86021bdd4715f2f160b4eaa6\"}');");
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE `wp` FROM `weather_provider` `wp` WHERE `wp`.`id` IN (1, 2);');
    }
}
