<?php

namespace App\Services\Name;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * Service class to generate usernames based on provided name.
 */
class UsernameService
{
    /**
     * @var array List of nouns used in username generation.
     */
    private array $nouns;

    /**
     * @var array List of adjectives used in username generation.
     */
    private array $adjectives;

    /**
     * @var array List of unique or themed words used in username generation.
     */
    private array $uniqueWords;

    /**
     * Constructor to load word sets.
     */
    public function __construct()
    {
        $this->loadWordSets();
    }

    /**
     * Generates a list of usernames based on the provided name.
     *
     * @param  string  $name  The name to base the usernames on.
     * @return Collection A collection of creative usernames.
     */
    public function generateUsernames(string $name): Collection
    {
        $name = normalize_name($name);
        $name = sanitize_name($name);

        return $this->createUsernames($name);
    }

    /**
     * Creates usernames using the sanitized name and various word combinations.
     *
     * @param  string  $name  The sanitized name to use in the usernames.
     * @return Collection A collection of creative usernames.
     */
    private function createUsernames(string $name): Collection
    {
        $usernames = [];

        $usernames[] = $name.'The'.ucfirst(random_word($this->uniqueWords));
        $usernames[] = random_word($this->adjectives).ucfirst($name).random_word($this->nouns);
        $usernames[] = $name.'Of'.ucfirst(random_word($this->nouns));
        $usernames[] = random_word($this->adjectives).'And'.ucfirst(random_word($this->uniqueWords)).ucfirst($name);
        $usernames[] = $name.'_'.random_word($this->adjectives).ucfirst(random_word($this->nouns));

        return collect($usernames);
    }

    /**
     * Loads the sets of words used in username generation.
     */
    private function loadWordSets(): void
    {
        $this->nouns = [
            'sky', 'star', 'fire', 'wave', 'shadow', 'mountain', 'river', 'ocean', 'forest', 'stone',
            'cloud', 'thunder', 'light', 'wind', 'rain', 'flame', 'earth', 'snow', 'sunset', 'dawn',
            'glow', 'leaf', 'tree', 'breeze', 'moon', 'sun', 'sand', 'sea', 'rock', 'valley',
            'waterfall', 'glacier', 'meadow', 'volcano', 'fjord', 'canyon', 'lake', 'peak', 'bay', 'beach',
            'cave', 'desert', 'island', 'jungle', 'reef', 'swamp', 'tundra', 'water', 'wood',
            'dream', 'lightning', 'night', 'silence', 'sound', 'time', 'heart', 'spirit', 'life',
            'dreamer', 'soul', 'world', 'infinity', 'eternity', 'hope', 'fate', 'freedom',
            'liberty', 'justice', 'memory', 'imagination', 'idea', 'art', 'chaos', 'balance', 'nature',
            'peace', 'warrior', 'poet', 'artist', 'seeker', 'traveler', 'sailor', 'pilot', 'soldier',
            'hunter', 'mage', 'priest', 'king', 'queen', 'prince', 'princess', 'emperor', 'empress', 'wizard',
            'knight', 'ninja', 'samurai', 'ranger', 'druid', 'shaman', 'dancer', 'singer', 'musician',
            'bard', 'cleric', 'rogue', 'paladin', 'warlock', 'monk', 'barbarian', 'sorcerer', 'fighter',
        ];

        $this->adjectives = [
            'swift', 'silent', 'happy', 'bright', 'dark', 'light', 'bold', 'brave', 'calm', 'clever',
            'cool', 'cozy', 'crazy', 'daring', 'dazzling', 'eager', 'fancy', 'fierce', 'gentle', 'giant',
            'glamorous', 'gleaming', 'graceful', 'grand', 'great', 'jolly', 'joyful', 'kind', 'lively', 'lovely',
            'lucky', 'mighty', 'mysterious', 'nice', 'playful', 'proud', 'quiet', 'shy', 'silly',
            'sleepy', 'small', 'smart', 'smooth', 'sparkling', 'strong', 'sweet', 'tall', 'tiny', 'wild',
            'witty', 'wonderful', 'zany', 'zealous', 'ancient', 'autumn', 'billowing', 'bitter', 'black', 'blue',
            'broad', 'broken', 'crimson', 'curly', 'damp', 'dawn', 'delicate', 'divine', 'dry', 'empty',
            'falling', 'flat', 'floral', 'fragrant', 'frosty', 'green', 'hidden', 'holy', 'icy', 'late',
            'lingering', 'long', 'misty', 'morning', 'muddy', 'mute', 'nameless', 'noisy', 'odd',
            'orange', 'patient', 'plain', 'polished', 'purple', 'rapid', 'raspy', 'red', 'restless', 'rough',
            'round', 'royal', 'shiny', 'shrill', 'snowy', 'soft', 'solitary', 'spring', 'square', 'steep',
            'still', 'summer', 'super', 'throbbing', 'tight', 'twilight', 'wandering', 'weathered', 'white', 'winter',
            'wispy', 'withered', 'yellow', 'young', 'chubby', 'curved', 'deep', 'high', 'hollow',
            'low', 'narrow', 'refined', 'shallow', 'skinny', 'straight', 'wide', 'big', 'colossal',
            'gigantic', 'huge', 'immense', 'large', 'little', 'mammoth', 'massive', 'microscopic', 'miniature', 'petite',
            'puny', 'scrawny', 'short', 'teeny', 'mini', 'giant', 'tremendous', 'vast', 'enormous', 'delightful',
            'elegant', 'exquisite', 'fancy', 'gorgeous', 'graceful', 'magnificent', 'splendid', 'stunning', 'dazzling', 'glorious',
            'lovely', 'radiant', 'adorable', 'beautiful', 'cute', 'dainty', 'pleasant', 'pretty', 'angelic', 'divine',
            'heavenly', 'ideal', 'lofty', 'saintly', 'sublime', 'ethereal', 'holy', 'sacred', 'spiritual', 'blessed',
            'blissful', 'divine', 'rapturous', 'reverent', 'serene', 'spiritual', 'tranquil', 'zen', 'peaceful', 'calm',
        ];

        $this->uniqueWords = [
            'musician', 'champion', 'leader', 'captain', 'bard', 'prince', 'barbarian',
            'pirate', 'scout', 'shaman', 'chief', 'ranger', 'druid', 'monk', 'guardian',
            'voyager', 'samurai', 'warlock', 'emperor', 'warrior', 'king', 'cleric', 'ace',
            'hunter', 'knight', 'ninja', 'singer', 'hero', 'fighter', 'alien', 'master', 'paladin',
            'agent', 'sage', 'wizard', 'empress', 'commander', 'mage', 'pilot', 'sorcerer',
        ];
    }

    //https://dnschecker.org/social-media-name-checker.php

    /**
     * Checks the availability of the provided username on various social media sites.
     *
     * @param  string  $username  The username to check.
     * @return array An array of social media sites and their availability status.
     */
    public function checkUsernameAvailability(string $username): array
    {
        $sites = [
            'Facebook' => 'https://www.facebook.com/',
            'YouTube' => 'https://www.youtube.com/c/',
            'Instagram' => 'https://www.instagram.com/',
            'Twitter' => 'https://twitter.com/',
            'LinkedIn' => 'https://www.linkedin.com/in/',
            'Snapchat' => 'https://www.snapchat.com/add/',
            'TikTok' => 'https://www.tiktok.com/@',
            'Reddit' => 'https://www.reddit.com/user/',
            'Twitch' => 'https://www.twitch.tv/',
            'Steam' => 'https://steamcommunity.com/id/',
        ];

        $results = [];

        foreach ($sites as $siteName => $url) {
            $url = $url.$username;
            $response = Http::get($url);

            $results[] = [
                'siteName' => $siteName,
                'url' => $url,
                'available' => $response->status() === 404,
            ];
        }

        return $results;
    }
}
