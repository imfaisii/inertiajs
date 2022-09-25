<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const ACTIVE = 'active';
    const UNACTIVE = 'unactive';

    protected $fillable = ['body', 'status', 'user_id'];

    protected $casts = ['created_at' => 'datetime:d M Y'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getStatuses()
    {
        return [self::ACTIVE, self::UNACTIVE];
    }
}
