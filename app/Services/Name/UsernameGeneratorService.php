<?php

namespace App\Services\Name;

/**
 * Service class to generate usernames based on provided names.
 */
class UsernameGeneratorService
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
     * @param string $name The name to base the usernames on.
     * @return array An array of generated usernames.
     */
    public function generateUsernames(string $name): array
    {
        $sanitized = $this->sanitizeName($name);
        return $this->createUsernames($sanitized);
    }

    /**
     * Sanitizes the provided name by lowercase and removing non-alphanumeric characters.
     *
     * @param string $name The name to be sanitized.
     * @return string The sanitized name.
     */
    private function sanitizeName(string $name): string
    {
        return strtolower(preg_replace('/[^A-Za-z0-9]/', '', $name));
    }

    /**
     * Creates usernames using the sanitized name and various word combinations.
     *
     * @param string $sanitized The sanitized name.
     * @return array An array of creative usernames.
     */
    private function createUsernames(string $sanitized): array
    {
        $usernames = [];

        $usernames[] = $sanitized . 'The' . ucfirst($this->randomWord($this->uniqueWords));
        $usernames[] = $this->randomWord($this->adjectives) . ucfirst($sanitized) . $this->randomWord($this->nouns);
        $usernames[] = $sanitized . 'Of' . ucfirst($this->randomWord($this->nouns));
        $usernames[] = $this->randomWord($this->adjectives) . 'And' . ucfirst($this->randomWord($this->uniqueWords)) . ucfirst($sanitized);
        $usernames[] = $sanitized . '_' . $this->randomWord($this->adjectives) . ucfirst($this->randomWord($this->nouns));

        return $usernames;
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
            'witch', 'knight', 'ninja', 'samurai', 'ranger', 'druid', 'shaman', 'dancer', 'singer', 'musician',
            'bard', 'cleric', 'rogue', 'paladin', 'warlock', 'monk', 'barbarian', 'sorcerer', 'fighter'
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
            'wispy', 'withered', 'yellow', 'young', 'chubby', 'crooked', 'curved', 'deep', 'high', 'hollow',
            'low', 'narrow', 'refined', 'shallow', 'skinny', 'straight', 'wide', 'big', 'colossal', 'fat',
            'gigantic', 'huge', 'immense', 'large', 'little', 'mammoth', 'massive', 'microscopic', 'miniature', 'petite',
            'puny', 'scrawny', 'short', 'teeny', 'mini', 'giant', 'tremendous', 'vast', 'enormous', 'delightful',
            'elegant', 'exquisite', 'fancy', 'gorgeous', 'graceful', 'magnificent', 'splendid', 'stunning', 'dazzling', 'glorious',
            'lovely', 'radiant', 'adorable', 'beautiful', 'cute', 'dainty', 'pleasant', 'pretty', 'angelic', 'divine',
            'heavenly', 'ideal', 'lofty', 'saintly', 'sublime', 'ethereal', 'holy', 'sacred', 'spiritual', 'blessed',
            'blissful', 'divine', 'rapturous', 'reverent', 'serene', 'spiritual', 'tranquil', 'zen', 'peaceful', 'calm'
        ];

        $this->uniqueWords = [
            'ninja', 'wizard', 'ranger', 'druid', 'knight', 'pirate', 'robot', 'alien', 'samurai', 'king',
            'queen', 'prince', 'princess', 'ace', 'agent', 'captain', 'champion', 'chief', 'commander', 'guardian',
            'hero', 'leader', 'master', 'pilot', 'sage', 'scout', 'shaman', 'warrior', 'voyager',
            'hunter', 'mage', 'priest', 'emperor', 'empress', 'witch', 'dancer', 'singer', 'musician',
            'bard', 'cleric', 'rogue', 'paladin', 'warlock', 'monk', 'barbarian', 'sorcerer', 'fighter'
        ];
    }

    /**
     * Selects a random word from the provided word list.
     *
     * @param array $wordList The list of words to choose from.
     * @return string A randomly selected word.
     */
    private function randomWord(array $wordList): string
    {
        return $wordList[array_rand($wordList)];
    }






//private $usernames = [
//'facebook' => $this->usernameGeneratorService->generateFacebookUsername($name),
//'twitter' => $this->usernameGeneratorService->generateTwitterUsername($name),
//'instagram' => $this->usernameGeneratorService->generateInstagramUsername($name),
//'tiktok' => $this->usernameGeneratorService->generateTiktokUsername($name),
//'snapchat' => $this->usernameGeneratorService->generateSnapchatUsername($name),
//'youtube' => $this->usernameGeneratorService->generateYoutubeUsername($name),
//'pinterest' => $this->usernameGeneratorService->generatePinterestUsername($name),
//'twitch' => $this->usernameGeneratorService->generateTwitchUsername($name),
//'soundcloud' => $this->usernameGeneratorService->generateSoundcloudUsername($name),
//'reddit' => $this->usernameGeneratorService->generateRedditUsername($name),
//'spotify' => $this->usernameGeneratorService->generateSpotifyUsername($name),
//'github' => $this->usernameGeneratorService->generateGithubUsername($name),
//'linkedin' => $this->usernameGeneratorService->generateLinkedinUsername($name),
//'tumblr' => $this->usernameGeneratorService->generateTumblrUsername($name),
//'flickr' => $this->usernameGeneratorService->generateFlickrUsername($name),
//'vimeo' => $this->usernameGeneratorService->generateVimeoUsername($name),
//'mixer' => $this->usernameGeneratorService->generateMixerUsername($name),
//'cashapp' => $this->usernameGeneratorService->generateCashappUsername($name),
//'onlyfans' => $this->usernameGeneratorService->generateOnlyfansUsername($name),
//'patreon' => $this->usernameGeneratorService->generatePatreonUsername($name),
//'paypal' => $this->usernameGeneratorService->generatePaypalUsername($name),
//'ebay' => $this->usernameGeneratorService->generateEbayUsername($name),
//'etsy' => $this->usernameGeneratorService->generateEtsyUsername($name),
//'amazon' => $this->usernameGeneratorService->generateAmazonUsername($name),
//'ebay' => $this->usernameGeneratorService->generateEbayUsername($name),
//'tinder' => $this->usernameGeneratorService->generateTinderUsername($name),
//'badoo' => $this->usernameGeneratorService->generateBadooUsername($name),
//'okcupid' => $this->usernameGeneratorService->generateOkcupidUsername($name),
//'zoosk' => $this->usernameGeneratorService->generateZooskUsername($name),
//];
//
}
