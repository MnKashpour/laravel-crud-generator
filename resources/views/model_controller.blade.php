namespace {{ $namespace }};

use App\Http\Controllers\Controller;
use {{ $fullModelClass }};
use {{ $fullCreateRequestClass }};
use {{ $fullUpdateRequestClass }};
use {{ $fullResourceClass }};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @group {{$model}} Management
 */
class {{ $class }} extends Controller
{
    /**
     * Get all {{ $model }}.
     * 
     * @queryParam filter[] string No-example
     */
    public function index()
    {
        ${{ str($model)->plural()->camel()->value() }} = QueryBuilder::for({{$model}}::class)
            ->allowedFilters([
                // AllowedFilter::partial('name'),
            ])
            ->defaultSort('-id')
            ->paginate();

        return {{ class_basename($fullResourceClass) }}::collection(${{ str($model)->plural()->camel()->value() }});
    }

    /**
     * Create a new {{ $model }}.
     */
    public function store({{ class_basename($fullCreateRequestClass) }} $request)
    {
        $validated = $request->validated();

        //$validated['status'] = ;

        ${{ str($model)->camel()->value() }} = {{ $model }}::create($validated);

        return {{ class_basename($fullResourceClass) }}::make(${{ str($model)->camel()->value() }})->additional([
            'message' => __('general.created_successfully'),
        ]);
    }

    /**
     * Get the specified {{ $model }}.
     */
    public function show({{ $model }} ${{ str($model)->camel()->value() }})
    {
        // ${{ str($model)->camel()->value() }}->load([]);

        return {{ class_basename($fullResourceClass) }}::make(${{ str($model)->camel()->value() }});
    }

    /**
     * Update {{ $model }}.
     */
    public function update({{ class_basename($fullUpdateRequestClass) }} $request, {{ $model }} ${{ str($model)->camel()->value() }})
    {
        $validated = $request->validated();

        ${{ str($model)->camel()->value() }}->update($validated);

        return {{ class_basename($fullResourceClass) }}::make(${{ str($model)->camel()->value() }})->additional([
            'message' => successWithMessage(__('general.updated_successfully')),
        ]);
    }

    /**
     * Delete {{ $model }}.
     */
    public function destroy({{ $model }} ${{ str($model)->camel()->value() }})
    {
        ${{ str($model)->camel()->value() }}->delete();

        return successWithMessage(__('general.deleted_successfully'));
    }

    // /**
    //  * Update the specified {{ $model }} status.
    //  */
    // public function updateStatus(Request $request, {{ $model }} ${{ str($model)->camel()->value() }})
    // {
    //     $validated = $request->validate([
    //         'status' => ['required', 'string', Rule::in(enumValues(??::class))],
    //     ]);
    //     $newStatus = $validated['status'];

    //     ${{ str($model)->camel()->value() }}->update([
    //         'status' => $newStatus,
    //     ]);

    //     return successWithMessage(__('general.done_successfully'));
    // }
}
