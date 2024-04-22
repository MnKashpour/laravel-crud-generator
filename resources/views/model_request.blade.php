
namespace {{ $namespace }};

use Illuminate\Foundation\Http\FormRequest;

class {{ $class }} extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * Document validation rules for api docs with 'scribe'
     *
     * @return array<string, array>
     */
    public function bodyParameters(){
        return [
            //
        ];
    }
}
