
use {{ $fullModelClass }};

it('can get paginated {{ str(class_basename($fullModelClass))->plural()->studly()->value() }}', function () {
    ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }} = {{ class_basename($fullModelClass) }}::factory()->create();

    // $response = loginAdmin()->get('/api/v1/???');
    // $response = loginEnduser()->get('/api/v1/???');

    $response->assertStatus(200);
    $response->assertJson([
        'data' => [],
        'meta' => [],
    ]);
    $response->assertJsonCount(1, 'data');
    $response->assertJsonPath('data.0.id', ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }}->id);
});

it('can create {{ str(class_basename($fullModelClass))->camel()->singular()->value() }}', function () {
    // $response = loginAdmin()->post("/api/v1/???", [
        //
    // ]);
    // $response = loginEnduser()->post("/api/v1/???", [
        //
    // ]);

    $response->assertStatus(201);
    $response->assertJsonPath('data.id', 1);

    ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }} = {{ class_basename($fullModelClass) }}::latest()->first();

    expect({{ class_basename($fullModelClass) }}::count())->toBe(1);
});

it('can get specific {{ str(class_basename($fullModelClass))->camel()->singular()->value() }}', function () {
    ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }} = {{ class_basename($fullModelClass) }}::factory()->create();

    // $response = loginAdmin()->get("/api/v1/???");
    // $response = loginEnduser()->get("/api/v1/???");

    $response->assertStatus(200);
    $response->assertJson([
        'data' => [],
    ]);
    $response->assertJsonPath('data.id', ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }}->id);
});

it('can update {{ str(class_basename($fullModelClass))->camel()->singular()->value() }}', function () {
    ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }} = {{ class_basename($fullModelClass) }}::factory()->create();

    // $response = loginAdmin()->put("/api/v1/???", [
    //     //
    // ]);
    // $response = loginEnduser()->put("/api/v1/???", [
    //     //
    // ]);

    $response->assertStatus(200);
    $response->assertJsonPath('data.id', 1);

    ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }} = {{ class_basename($fullModelClass) }}::latest()->first();

    expect({{ class_basename($fullModelClass) }}::count())->toBe(1);
});

it('can delete {{ str(class_basename($fullModelClass))->camel()->singular()->value() }}', function () {
    ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }} = {{ class_basename($fullModelClass) }}::factory()->create();

    expect({{ class_basename($fullModelClass) }}::count())->toBe(1);

    // $response = loginAdmin()->delete("/api/v1/???");
    // $response = loginEnduser()->delete("/api/v1/???");

    $response->assertStatus(200);

    expect({{ class_basename($fullModelClass) }}::count())->toBe(0);
});

// it('can update {{ str(class_basename($fullModelClass))->camel()->singular()->value() }} status', function () {
//     ${{ str(class_basename($fullModelClass))->camel()->singular()->value() }} = {{ class_basename($fullModelClass) }}::factory()->create();
// 
//     $response = loginAdmin()->put("/api/v1/???", [
//         'status' => ???::???->value,
//     ]);
// 
//     $response->assertStatus(200);
// 
//     expect({{ class_basename($fullModelClass) }}::latest()->first()->status)->toBe(???::???);
// });
