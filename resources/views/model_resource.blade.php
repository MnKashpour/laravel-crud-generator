
namespace {{ $namespace }};

use App\Http\Resources\Admin\Posts\PostResource;
use App\Http\Resources\Admin\Resources\ResourceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// /** @mixin \{{ $fullModelClass }} */
class {{ $class }} extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
