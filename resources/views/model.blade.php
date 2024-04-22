
namespace {{ $namespace }};

use App\Utility\Traits\HasIdKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

@if($includeActivity)
use App\Models\ActivityLog\Activity;
use App\Utility\Enums\ActivityLog\ActivityLogName;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
@endif

class {{ $class }} extends Model
{
    use HasFactory, HasIdKey, LogsActivity;

    protected $fillable = [
        //
    ];

    protected $casts = [
        //
    ];

    /*
     * ==================== Scopes =======================
     */

    /* 
     * ================== Attributes =====================
     */

    /* 
     * ================== Relations ======================
     */

    /* 
     * =============== Custom functions ==================
     */

    /* 
     * =============== Static functions ==================
     */

    /* 
     * =============== Activity Log ==================
     */

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                //
            ])
            ->dontLogIfAttributesChangedOnly([
                'updated_at',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName(ActivityLogName::General->value); //TODO rename log_name
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->activity_group_id = $this->id;
        $activity->item_name = $this->name; //TODO rename item_name

        $activity->addGroupToBeSaved(ActivityLogName::General->value, $this->id); //TODO rename log_name
    }
}
