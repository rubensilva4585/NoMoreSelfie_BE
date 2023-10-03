<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property int $inPerson
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubCategory> $subCategory
 * @property-read int|null $sub_category_count
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereInPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Profile> $profile
 * @property-read int|null $profile_count
 * @method static \Database\Factories\DistrictFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|District withoutTrashed()
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string $role
 * @property int $district_id
 * @property string|null $dob
 * @property string|null $phone
 * @property string|null $company
 * @property string $nif
 * @property string|null $address
 * @property string|null $bio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\District $district
 * @property-read \App\Models\Social|null $social
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withoutTrashed()
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Request
 *
 * @property int $id
 * @property int $profile_id
 * @property int $category_id
 * @property int|null $subCategory_id
 * @property string $date
 * @property string|null $address
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\SubCategory|null $subCategory
 * @method static \Database\Factories\RequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Request query()
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Request withoutTrashed()
 */
	class Request extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Social
 *
 * @property int $user_id
 * @property string|null $website
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $linkedin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $user
 * @method static \Database\Factories\SocialFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Social onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Social query()
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Social withoutTrashed()
 */
	class Social extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubCategory
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category $category
 * @method static \Database\Factories\SubCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory withoutTrashed()
 */
	class SubCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserSubCategory|null $userSubCategory
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSubCategory
 *
 * @property int $user_id
 * @property int $subcategory_id
 * @property string $startPrice
 * @property string $endPrice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\SubCategory $subcategory
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserSubCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory whereEndPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory whereStartPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory whereSubcategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubCategory withoutTrashed()
 */
	class UserSubCategory extends \Eloquent {}
}

