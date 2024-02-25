<?php

namespace App\Services\Tools;

use Illuminate\Support\Collection;

class FancyTextService
{
    private array $styles = [
        'style1_map' => [
            'a' => '【a】', 'b' => '【b】', 'c' => '【c】', 'd' => '【d】', 'e' => '【e】', 'f' => '【f】', 'g' => '【g】',
            'h' => '【h】', 'i' => '【i】', 'j' => '【j】', 'k' => '【k】', 'l' => '【l】', 'm' => '【m】', 'n' => '【n】',
            'o' => '【o】', 'p' => '【p】', 'q' => '【q】', 'r' => '【r】', 's' => '【s】', 't' => '【t】', 'u' => '【u】',
            'v' => '【v】', 'w' => '【w】', 'x' => '【x】', 'y' => '【y】', 'z' => '【z】',
        ],

        'style2_map' => [
            'a' => '『a』', 'b' => '『b』', 'c' => '『c』', 'd' => '『d』', 'e' => '『e』', 'f' => '『f』', 'g' => '『g』',
            'h' => '『h』', 'i' => '『i』', 'j' => '『j』', 'k' => '『k』', 'l' => '『l』', 'm' => '『m』', 'n' => '『n』',
            'o' => '『o』', 'p' => '『p』', 'q' => '『q』', 'r' => '『r』', 's' => '『s』', 't' => '『t』', 'u' => '『u』',
            'v' => '『v』', 'w' => '『w』', 'x' => '『x』', 'y' => '『y』', 'z' => '『z』',
        ],

        'style3_map' => [
            'a' => '≋a≋', 'b' => '≋b≋', 'c' => '≋c≋', 'd' => '≋d≋', 'e' => '≋e≋', 'f' => '≋f≋', 'g' => '≋g≋',
            'h' => '≋h≋', 'i' => '≋i≋', 'j' => '≋j≋', 'k' => '≋k≋', 'l' => '≋l≋', 'm' => '≋m≋', 'n' => '≋n≋',
            'o' => '≋o≋', 'p' => '≋p≋', 'q' => '≋q≋', 'r' => '≋r≋', 's' => '≋s≋', 't' => '≋t≋', 'u' => '≋u≋',
            'v' => '≋v≋', 'w' => '≋w≋', 'x' => '≋x≋', 'y' => '≋y≋', 'z' => '≋z≋',
        ],

        'style4_map' => [
            'a' => '░a░', 'b' => '░b░', 'c' => '░c░', 'd' => '░d░', 'e' => '░e░', 'f' => '░f░', 'g' => '░g░',
            'h' => '░h░', 'i' => '░i░', 'j' => '░j░', 'k' => '░k░', 'l' => '░l░', 'm' => '░m░', 'n' => '░n░',
            'o' => '░o░', 'p' => '░p░', 'q' => '░q░', 'r' => '░r░', 's' => '░s░', 't' => '░t░', 'u' => '░u░',
            'v' => '░v░', 'w' => '░w░', 'x' => '░x░', 'y' => '░y░', 'z' => '░z░',
        ],

        'style5_map' => [
            'a' => '꜍a꜉', 'b' => '꜍b꜉', 'c' => '꜍c꜉', 'd' => '꜍d꜉', 'e' => '꜍e꜉', 'f' => '꜍f꜉', 'g' => '꜍g꜉', 'h' => '꜍h꜉', 'i' => '꜍i꜉',
            'j' => '꜍j꜉', 'k' => '꜍k꜉', 'l' => '꜍l꜉', 'm' => '꜍m꜉', 'n' => '꜍n꜉', 'o' => '꜍o꜉', 'p' => '꜍p꜉', 'q' => '꜍q꜉', 'r' => '꜍r꜉',
            's' => '꜍s꜉', 't' => '꜍t꜉', 'u' => '꜍u꜉', 'v' => '꜍v꜉', 'w' => '꜍w꜉', 'x' => '꜍x꜉', 'y' => '꜍y꜉', 'z' => '꜍z꜉',
        ],

        'style6_map' => [
            'a' => '卂', 'b' => '乃', 'c' => '匚', 'd' => 'ᗪ', 'e' => '乇', 'f' => '千', 'g' => 'Ꮆ', 'h' => '卄', 'i' => '丨',
            'j' => 'ﾌ', 'k' => 'Ҝ', 'l' => 'ㄥ', 'm' => '爪', 'n' => '几', 'o' => 'ㄖ', 'p' => '卩', 'q' => 'Ɋ', 'r' => '尺',
            's' => '丂', 't' => 'ㄒ', 'u' => 'ㄩ', 'v' => 'ᐯ', 'w' => '山', 'x' => '乂', 'y' => 'ㄚ', 'z' => '乙',
        ],

        'style7_map' => [
            'a' => 'ﾑ', 'b' => '乃', 'c' => 'ᄃ', 'd' => 'り', 'e' => '乇', 'f' => 'ｷ', 'g' => 'ム', 'h' => 'ん', 'i' => 'ﾉ',
            'j' => 'ﾌ', 'k' => 'ズ', 'l' => 'ﾚ', 'm' => 'ﾶ', 'n' => '刀', 'o' => 'の', 'p' => 'ｱ', 'q' => 'ゐ', 'r' => '尺',
            's' => '丂', 't' => 'ｲ', 'u' => 'ひ', 'v' => '√', 'w' => 'W', 'x' => 'ﾒ', 'y' => 'ﾘ', 'z' => '乙',
        ],

        'style8_map' => [
            'a' => 'ค', 'b' => 'ც', 'c' => '८', 'd' => 'ძ', 'e' => '૯', 'f' => 'Բ', 'g' => '૭', 'h' => 'Һ', 'i' => 'ɿ',
            'j' => 'ʆ', 'k' => 'қ', 'l' => 'Ն', 'm' => 'ɱ', 'n' => 'Ո', 'o' => '૦', 'p' => 'ƿ', 'q' => 'ҩ', 'r' => 'Ր',
            's' => 'ς', 't' => '੮', 'u' => 'υ', 'v' => '౮', 'w' => 'ω', 'x' => '૪', 'y' => 'ע', 'z' => 'ઽ',
        ],

        'style9_map' => [
            'a' => 'а', 'b' => 'б', 'c' => 'c', 'd' => 'д', 'e' => 'ё', 'f' => 'f', 'g' => 'g', 'h' => 'н', 'i' => 'ї',
            'j' => 'j', 'k' => 'к', 'l' => 'г', 'm' => 'ѫ', 'n' => 'п', 'o' => 'ѳ', 'p' => 'p', 'q' => 'ф', 'r' => 'я',
            's' => '$', 't' => 'т', 'u' => 'ц', 'v' => 'ѵ', 'w' => 'щ', 'x' => 'ж', 'y' => 'ч', 'z' => 'з',
        ],

        'style10_map' => [
            'a' => 'Д', 'b' => 'Б', 'c' => 'C', 'd' => 'D', 'e' => 'Ξ', 'f' => 'F', 'g' => 'G', 'h' => 'H', 'i' => 'I',
            'j' => 'J', 'k' => 'Ҝ', 'l' => 'L', 'm' => 'M', 'n' => 'И', 'o' => 'Ф', 'p' => 'P', 'q' => 'Ǫ', 'r' => 'Я',
            's' => 'S', 't' => 'Γ', 'u' => 'Ц', 'v' => 'V', 'w' => 'Щ', 'x' => 'Ж', 'y' => 'У', 'z' => 'Z',
        ],

        'style11_map' => [
            'a' => 'å⫶', 'b' => 'b̊⫶', 'c' => 'c̊⫶', 'd' => 'd̊⫶', 'e' => 'e̊⫶', 'f' => 'f̊⫶', 'g' => 'g̊⫶', 'h' => 'h̊⫶', 'i' => 'i̊⫶',
            'j' => 'j̊⫶', 'k' => 'k̊⫶', 'l' => 'l̊⫶', 'm' => 'm̊⫶', 'n' => 'n̊⫶', 'o' => 'o̊⫶', 'p' => 'p̊⫶', 'q' => 'q̊⫶', 'r' => 'r̊⫶',
            's' => 's̊⫶', 't' => 't̊⫶', 'u' => 'ů⫶', 'v' => 'v̊⫶', 'w' => 'ẘ⫶', 'x' => 'x̊⫶', 'y' => 'ẙ⫶', 'z' => 'z̊⫶',
        ],

        'style12_map' => [
            'a' => 'a⊶', 'b' => 'b⊶', 'c' => 'c⊶', 'd' => 'd⊶', 'e' => 'e⊶', 'f' => 'f⊶', 'g' => 'g⊶', 'h' => 'h⊶', 'i' => 'i⊶',
            'j' => 'j⊶', 'k' => 'k⊶', 'l' => 'l⊶', 'm' => 'm⊶', 'n' => 'n⊶', 'o' => 'o⊶', 'p' => 'p⊶', 'q' => 'q⊶', 'r' => 'r⊶',
            's' => 's⊶', 't' => 't⊶', 'u' => 'u⊶', 'v' => 'v⊶', 'w' => 'w⊶', 'x' => 'x⊶', 'y' => 'y⊶', 'z' => 'z⊶',
        ],

        'style13_map' => [
            'a' => 'a͎͍͐￫', 'b' => 'b͎͍͐￫', 'c' => 'c͎͍͐￫', 'd' => 'd͎͍͐￫', 'e' => 'e͎͍͐￫', 'f' => 'f͎͍͐￫', 'g' => 'g͎͍͐￫', 'h' => 'h͎͍͐￫', 'i' => 'i͎͍͐￫',
            'j' => 'j͎͍͐￫', 'k' => 'k͎͍͐￫', 'l' => 'l͎͍͐￫', 'm' => 'm͎͍͐￫', 'n' => 'n͎͍͐￫', 'o' => 'o͎͍͐￫', 'p' => 'p͎͍͐￫', 'q' => 'q͎͍͐￫', 'r' => 'r͎͍͐￫',
            's' => 's͎͍͐￫', 't' => 't͎͍͐￫', 'u' => 'u͎͍͐￫', 'v' => 'v͎͍͐￫', 'w' => 'w͎͍͐￫', 'x' => 'x͎͍͐￫', 'y' => 'y͎͍͐￫', 'z' => 'z͎͍͐￫',
        ],

        'style14_map' => [
            'a' => 'a⋆', 'b' => 'b⋆', 'c' => 'c⋆', 'd' => 'd⋆', 'e' => 'e⋆', 'f' => 'f⋆', 'g' => 'g⋆', 'h' => 'h⋆', 'i' => 'i⋆',
            'j' => 'j⋆', 'k' => 'k⋆', 'l' => 'l⋆', 'm' => 'm⋆', 'n' => 'n⋆', 'o' => 'o⋆', 'p' => 'p⋆', 'q' => 'q⋆', 'r' => 'r⋆',
            's' => 's⋆', 't' => 't⋆', 'u' => 'u⋆', 'v' => 'v⋆', 'w' => 'w⋆', 'x' => 'x⋆', 'y' => 'y⋆', 'z' => 'z⋆',
        ],

        'style15_map' => [
            'a' => 'a⨳', 'b' => 'b⨳', 'c' => 'c⨳', 'd' => 'd⨳', 'e' => 'e⨳', 'f' => 'f⨳', 'g' => 'g⨳', 'h' => 'h⨳', 'i' => 'i⨳',
            'j' => 'j⨳', 'k' => 'k⨳', 'l' => 'l⨳', 'm' => 'm⨳', 'n' => 'n⨳', 'o' => 'o⨳', 'p' => 'p⨳', 'q' => 'q⨳', 'r' => 'r⨳',
            's' => 's⨳', 't' => 't⨳', 'u' => 'u⨳', 'v' => 'v⨳', 'w' => 'w⨳', 'x' => 'x⨳', 'y' => 'y⨳', 'z' => 'z⨳',
        ],

        'style16_map' => [
            'a' => '⧼a̼⧽', 'b' => '⧼b̼⧽', 'c' => '⧼c̼⧽', 'd' => '⧼d̼⧽', 'e' => '⧼e̼⧽', 'f' => '⧼f̼⧽', 'g' => '⧼g̼⧽', 'h' => '⧼h̼⧽', 'i' => '⧼i̼⧽',
            'j' => '⧼j̼⧽', 'k' => '⧼k̼⧽', 'l' => '⧼l̼⧽', 'm' => '⧼m̼⧽', 'n' => '⧼n̼⧽', 'o' => '⧼o̼⧽', 'p' => '⧼p̼⧽', 'q' => '⧼q̼⧽', 'r' => '⧼r̼⧽',
            's' => '⧼s̼⧽', 't' => '⧼t̼⧽', 'u' => '⧼u̼⧽', 'v' => '⧼v̼⧽', 'w' => '⧼w̼⧽', 'x' => '⧼x̼⧽', 'y' => '⧼y̼⧽', 'z' => '⧼z̼⧽',
        ],

        'style17_map' => [
            'a' => '[a̲̅]', 'b' => '[b̲̅]', 'c' => '[c̲̅]', 'd' => '[d̲̅]', 'e' => '[e̲̅]', 'f' => '[f̲̅]', 'g' => '[g̲̅]', 'h' => '[h̲̅]', 'i' => '[i̲̅]',
            'j' => '[j̲̅]', 'k' => '[k̲̅]', 'l' => '[l̲̅]', 'm' => '[m̲̅]', 'n' => '[n̲̅]', 'o' => '[o̲̅]', 'p' => '[p̲̅]', 'q' => '[q̲̅]', 'r' => '[r̲̅]',
            's' => '[s̲̅]', 't' => '[t̲̅]', 'u' => '[u̲̅]', 'v' => '[v̲̅]', 'w' => '[w̲̅]', 'x' => '[x̲̅]', 'y' => '[y̲̅]', 'z' => '[z̲̅]',
        ],

        'style18_map' => [
            'a' => '⟦a⟧', 'b' => '⟦b⟧', 'c' => '⟦c⟧', 'd' => '⟦d⟧', 'e' => '⟦e⟧', 'f' => '⟦f⟧', 'g' => '⟦g⟧', 'h' => '⟦h⟧', 'i' => '⟦i⟧',
            'j' => '⟦j⟧', 'k' => '⟦k⟧', 'l' => '⟦l⟧', 'm' => '⟦m⟧', 'n' => '⟦n⟧', 'o' => '⟦o⟧', 'p' => '⟦p⟧', 'q' => '⟦q⟧', 'r' => '⟦r⟧',
            's' => '⟦s⟧', 't' => '⟦t⟧', 'u' => '⟦u⟧', 'v' => '⟦v⟧', 'w' => '⟦w⟧', 'x' => '⟦x⟧', 'y' => '⟦y⟧', 'z' => '⟦z⟧',
        ],

        'style19_map' => [
            'a' => '꜍a꜉', 'b' => '꜍b꜉', 'c' => '꜍c꜉', 'd' => '꜍d꜉', 'e' => '꜍e꜉', 'f' => '꜍f꜉', 'g' => '꜍g꜉', 'h' => '꜍h꜉', 'i' => '꜍i꜉',
            'j' => '꜍j꜉', 'k' => '꜍k꜉', 'l' => '꜍l꜉', 'm' => '꜍m꜉', 'n' => '꜍n꜉', 'o' => '꜍o꜉', 'p' => '꜍p꜉', 'q' => '꜍q꜉', 'r' => '꜍r꜉',
            's' => '꜍s꜉', 't' => '꜍t꜉', 'u' => '꜍u꜉', 'v' => '꜍v꜉', 'w' => '꜍w꜉', 'x' => '꜍x꜉', 'y' => '꜍y꜉', 'z' => '꜍z꜉',
        ],

        'style20_map' => [
            'a' => '⦏â⦎', 'b' => '⦏b̂⦎', 'c' => '⦏ĉ⦎', 'd' => '⦏d̂⦎', 'e' => '⦏ê⦎', 'f' => '⦏f̂⦎', 'g' => '⦏ĝ⦎', 'h' => '⦏ĥ⦎', 'i' => '⦏î⦎',
            'j' => '⦏ĵ⦎', 'k' => '⦏k̂⦎', 'l' => '⦏l̂⦎', 'm' => '⦏m̂⦎', 'n' => '⦏n̂⦎', 'o' => '⦏ô⦎', 'p' => '⦏p̂⦎', 'q' => '⦏q̂⦎', 'r' => '⦏r̂⦎',
            's' => '⦏ŝ⦎', 't' => '⦏t̂⦎', 'u' => '⦏û⦎', 'v' => '⦏v̂⦎', 'w' => '⦏ŵ⦎', 'x' => '⦏x̂⦎', 'y' => '⦏ŷ⦎', 'z' => '⦏ẑ⦎',
        ],

        'style26_map' => [
            'A' => 'Ⓐ', 'B' => 'Ⓑ', 'C' => 'Ⓒ', 'D' => 'Ⓓ', 'E' => 'Ⓔ',
            'F' => 'Ⓕ', 'G' => 'Ⓖ', 'H' => 'Ⓗ', 'I' => 'Ⓘ', 'J' => 'Ⓙ',
            'K' => 'Ⓚ', 'L' => 'Ⓛ', 'M' => 'Ⓜ', 'N' => 'Ⓝ', 'O' => 'Ⓞ',
            'P' => 'Ⓟ', 'Q' => 'Ⓠ', 'R' => 'Ⓡ', 'S' => 'Ⓢ', 'T' => 'Ⓣ',
            'U' => 'Ⓤ', 'V' => 'Ⓥ', 'W' => 'Ⓦ', 'X' => 'Ⓧ', 'Y' => 'Ⓨ',
            'Z' => 'Ⓩ',
        ],

        'style28_map' => [
            'A' => '𝒜', 'B' => 'ℬ', 'C' => '𝒞', 'D' => '𝒟', 'E' => 'ℰ',
            'F' => 'ℱ', 'G' => '𝒢', 'H' => 'ℋ', 'I' => 'ℐ', 'J' => '𝒥',
            'K' => '𝒦', 'L' => 'ℒ', 'M' => 'ℳ', 'N' => '𝒩', 'O' => '𝒪',
            'P' => '𝒫', 'Q' => '𝒬', 'R' => 'ℛ', 'S' => '𝒮', 'T' => '𝒯',
            'U' => '𝒰', 'V' => '𝒱', 'W' => '𝒲', 'X' => '𝒳', 'Y' => '𝒴',
            'Z' => '𝒵',
        ],

        'style31_map' => [
            'A' => '𝔸', 'B' => '𝔹', 'C' => 'ℂ', 'D' => '𝔻', 'E' => '𝔼',
            'F' => '𝔽', 'G' => '𝔾', 'H' => 'ℍ', 'I' => '𝕀', 'J' => '𝕁',
            'K' => '𝕂', 'L' => '𝕃', 'M' => '𝕄', 'N' => 'ℕ', 'O' => '𝕆',
            'P' => 'ℙ', 'Q' => 'ℚ', 'R' => 'ℝ', 'S' => '𝕊', 'T' => '𝕋',
            'U' => '𝕌', 'V' => '𝕍', 'W' => '𝕎', 'X' => '𝕏', 'Y' => '𝕐',
            'Z' => 'ℤ',
        ],

        'style32_map' => [
            'A' => '𝕬', 'B' => '𝕭', 'C' => '𝕮', 'D' => '𝕯', 'E' => '𝕰',
            'F' => '𝕱', 'G' => '𝕲', 'H' => '𝕳', 'I' => '𝕴', 'J' => '𝕵',
            'K' => '𝕶', 'L' => '𝕷', 'M' => '𝕸', 'N' => '𝕹', 'O' => '𝕺',
            'P' => '𝕻', 'Q' => '𝕼', 'R' => '𝕽', 'S' => '𝕾', 'T' => '𝕿',
            'U' => '𝖀', 'V' => '𝖁', 'W' => '𝖂', 'X' => '𝖃', 'Y' => '𝖄',
            'Z' => '𝖅',
        ],

        'style34_map' => [
            'A' => 'ᴀ', 'B' => 'ʙ', 'C' => 'ᴄ', 'D' => 'ᴅ', 'E' => 'ᴇ',
            'F' => 'ғ', 'G' => 'ɢ', 'H' => 'ʜ', 'I' => 'ɪ', 'J' => 'ᴊ',
            'K' => 'ᴋ', 'L' => 'ʟ', 'M' => 'ᴍ', 'N' => 'ɴ', 'O' => 'ᴏ',
            'P' => 'ᴘ', 'Q' => 'ǫ', 'R' => 'ʀ', 'S' => 's', 'T' => 'ᴛ',
            'U' => 'ᴜ', 'V' => 'ᴠ', 'W' => 'ᴡ', 'X' => 'x', 'Y' => 'ʏ',
            'Z' => 'ᴢ',
        ],

        'style35_map' => [
            'A' => 'ᗩ', 'B' => 'ᗷ', 'C' => 'ᑕ', 'D' => 'ᗪ', 'E' => 'E',
            'F' => 'ᖴ', 'G' => 'G', 'H' => 'ᕼ', 'I' => 'I', 'J' => 'ᒍ',
            'K' => 'K', 'L' => 'ᒪ', 'M' => 'ᗰ', 'N' => 'ᑎ', 'O' => 'O',
            'P' => 'ᑭ', 'Q' => 'ᑫ', 'R' => 'ᖇ', 'S' => 'ᔕ', 'T' => 'T',
            'U' => 'ᑌ', 'V' => 'ᐯ', 'W' => 'ᗯ', 'X' => '᙭', 'Y' => 'Y',
            'Z' => 'ᘔ',
        ],

        'style37_map' => [
            'A' => '∀', 'B' => 'ꓭ', 'C' => 'Ↄ', 'D' => '◖', 'E' => 'Ǝ',
            'F' => 'Ⅎ', 'G' => '⅁', 'H' => 'H', 'I' => 'I', 'J' => 'ſ',
            'K' => 'ꓘ', 'L' => '⅂', 'M' => 'W', 'N' => 'N', 'O' => 'O',
            'P' => 'Ԁ', 'Q' => 'Ό', 'R' => 'ꓤ', 'S' => 'S', 'T' => '⊥',
            'U' => '∩', 'V' => 'Λ', 'W' => 'M', 'X' => 'X', 'Y' => '⅄',
            'Z' => 'Z',
        ],

        'style38_map' => [
            'A' => '.-', 'B' => '-...', 'C' => '-.-.', 'D' => '-..', 'E' => '.',
            'F' => '..-.', 'G' => '--.', 'H' => '....', 'I' => '..', 'J' => '.---',
            'K' => '-.-', 'L' => '.-..', 'M' => '--', 'N' => '-.', 'O' => '---',
            'P' => '.--.', 'Q' => '--.-', 'R' => '.-.', 'S' => '...', 'T' => '-',
            'U' => '..-', 'V' => '...-', 'W' => '.--', 'X' => '-..-', 'Y' => '-.--',
            'Z' => '--..',
        ],

        'style39_map' => [
            'A' => '⠁', 'B' => '⠃', 'C' => '⠉', 'D' => '⠙', 'E' => '⠑',
            'F' => '⠋', 'G' => '⠛', 'H' => '⠓', 'I' => '⠊', 'J' => '⠚',
            'K' => '⠅', 'L' => '⠇', 'M' => '⠍', 'N' => '⠝', 'O' => '⠕',
            'P' => '⠏', 'Q' => '⠟', 'R' => '⠗', 'S' => '⠎', 'T' => '⠞',
            'U' => '⠥', 'V' => '⠧', 'W' => '⠺', 'X' => '⠭', 'Y' => '⠽',
            'Z' => '⠵',
        ],

        'style40_map' => [
            'A' => '🄰', 'B' => '🄱', 'C' => '🄲', 'D' => '🄳', 'E' => '🄴',
            'F' => '🄵', 'G' => '🄶', 'H' => '🄷', 'I' => '🄸', 'J' => '🄹',
            'K' => '🄺', 'L' => '🄻', 'M' => '🄼', 'N' => '🄽', 'O' => '🄾',
            'P' => '🄿', 'Q' => '🅀', 'R' => '🅁', 'S' => '🅂', 'T' => '🅃',
            'U' => '🅄', 'V' => '🅅', 'W' => '🅆', 'X' => '🅇', 'Y' => '🅈',
            'Z' => '🅉',
        ],

        'style41_map' => [
            'A' => '🅐', 'B' => '🅑', 'C' => '🅒', 'D' => '🅓', 'E' => '🅔',
            'F' => '🅕', 'G' => '🅖', 'H' => '🅗', 'I' => '🅘', 'J' => '🅙',
            'K' => '🅚', 'L' => '🅛', 'M' => '🅜', 'N' => '🅝', 'O' => '🅞',
            'P' => '🅟', 'Q' => '🅠', 'R' => '🅡', 'S' => '🅢', 'T' => '🅣',
            'U' => '🅤', 'V' => '🅥', 'W' => '🅦', 'X' => '🅧', 'Y' => '🅨',
            'Z' => '🅩',
        ],

        'style43_map' => [
            'A' => '🅰️', 'B' => '🅱️', 'C' => '🅲', 'D' => '🅳', 'E' => '🅴',
            'F' => '🅵', 'G' => '🅶', 'H' => '🅷', 'I' => '🅸', 'J' => '🅹',
            'K' => '🅺', 'L' => '🅻', 'M' => '🅼', 'N' => '🅽', 'O' => '🅾️',
            'P' => '🅿️', 'Q' => '🆀', 'R' => '🆁', 'S' => '🆂', 'T' => '🆃',
            'U' => '🆄', 'V' => '🆅', 'W' => '🆆', 'X' => '🆇', 'Y' => '🆈',
            'Z' => '🆉',
        ],

        'style44_map' => [
            'A' => 'A̲', 'B' => 'B̲', 'C' => 'C̲', 'D' => 'D̲', 'E' => 'E̲',
            'F' => 'F̲', 'G' => 'G̲', 'H' => 'H̲', 'I' => 'I̲', 'J' => 'J̲',
            'K' => 'K̲', 'L' => 'L̲', 'M' => 'M̲', 'N' => 'N̲', 'O' => 'O̲',
            'P' => 'P̲', 'Q' => 'Q̲', 'R' => 'R̲', 'S' => 'S̲', 'T' => 'T̲',
            'U' => 'U̲', 'V' => 'V̲', 'W' => 'W̲', 'X' => 'X̲', 'Y' => 'Y̲',
            'Z' => 'Z̲',
        ],

    ];

    /**
     * Generate a list of random emoji styles for a given name.
     *
     * @param string $name The name to stylize.
     * @param int $count The number of styles to generate.
     * @return Collection A collection of styled names with emojis.
     */
    public function generateEmojiStyles(string $name, int $count = 5): Collection
    {
        return collect(['❤️', '⭐', '🔥', '💎', '🎵', '🚀', '☀️', '❄️', '🎈', '🍃', '🌊', '😀'])
            ->shuffle()
            ->take($count)
            ->map(fn($emoji) => $this->generateEmojiStyle($name, $emoji));
    }

    /**
     * Generate a styled string with emojis around and within the given name.
     *
     * @param string $name The name to stylize.
     * @param string $emoji The emoji to use in the styling.
     * @return string The styled name.
     */
    public function generateEmojiStyle(string $name, string $emoji): string
    {
        $spacedName = implode($emoji, str_split(strtoupper($name)));
        return "{$emoji}{$spacedName}{$emoji}";
    }

     /**
     * Generate a specified number of custom styles for the name.
     *
     * @param string $name The name to apply custom styles to.
     * @param int $stylesCount The number of custom styles to generate.
     * @return Collection A collection of custom-styled names.
     */
    private function generateCustomStyles(string $name, int $stylesCount): Collection
    {
        $styleKeys = collect($this->styles)
            ->keys()
            ->shuffle()
            ->take($stylesCount);

        return $styleKeys->mapWithKeys(function ($styleName) use ($name) {
            // Apply each selected style to the name
            return [$styleName => $this->applyStyle($name, $this->styles[$styleName])];
        });
    }


    /**
     * Apply a predefined style to the name.
     *
     * @param string $name The name to style.
     * @param array $style The style mapping.
     * @return string The styled name.
     */
    private function applyStyle($name, $style): string
    {
        $lowercase_style = collect($style)->mapWithKeys(function ($value, $key) {
            return [strtolower($key) => $value];
        });

        return collect(str_split(strtolower($name)))
            ->map(fn($char) => $lowercase_style->get($char, $char))
            ->implode('');
    }

    /**
     * Generate a collection of styled names using both emoji and custom styles.
     *
     * @param string $name The name to stylize.
     * @param int $stylesCount The total number of styles to generate.
     * @return Collection A collection of styled names.
     */
    public function generate(string $name, int $stylesCount = 10): Collection
    {
        $name = normalize_name($name);

        $emojiStylesCount = 3;
        $customStylesCount = $stylesCount - $emojiStylesCount;

        // Generate both emoji and custom styles
        $emojiStyles = $this->generateEmojiStyles($name, $emojiStylesCount);
        $customStyles = $this->generateCustomStyles($name, $customStylesCount);

        // Combine and shuffle the resulting styles
        return $emojiStyles->merge($customStyles)->shuffle();
    }
}
