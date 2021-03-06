<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Tuan Linh
 * Date: 2015-09-02
 * Time: 20:25
 */

return [
    'extra'                                         => 'chuc-nang-bo-sung',
    'admin/extra'                                   => 'quan-tri/chuc-nang-bo-sung',
    'errors/{code}'                                 => 'ma-loi/{code}',
    'admin/errors/{code}'                           => 'quan-tri/ma-loi/{code}',

    'example/social-sharing'                        => 'vi-du/chia-se-len-mang-xa-hoi',
    'example/facebook-comments'                     => 'vi-du/binh-luan-bang-facebook',
    'example/widgets'                               => 'vi-du/cong-cu-hien-thi',
    'example/my-settings'                           => 'vi-du/thiet-lap-cua-toi',
    'example/pages'                                 => 'vi-du/chuyen-trang',
    'example/pages/{id}'                            => 'vi-du/chuyen-trang/{id}',
    'example/articles'                              => 'vi-du/chuyen-de',
    'example/articles/{id}'                         => 'vi-du/chuyen-de/{id}',
    'example/article-categories/{id}'               => 'vi-du/chuyen-muc-chuyen-de/{id}',
    'example/public-conversation'                   => 'vi-du/chuyen-tro-cong-khai',

    'me'                                            => 'ca-nhan-toi',
    'me/settings'                                   => 'ca-nhan-toi/thiet-lap',
    'me/account'                                    => 'ca-nhan-toi/tai-khoan',
    'me/documents'                                  => 'ca-nhan-toi/tai-lieu',
    'me/documents/connector'                        => 'ca-nhan-toi/tai-lieu/ket-noi',
    'me/documents/for/ckeditor'                     => 'ca-nhan-toi/tai-lieu/danh-cho/ckeditor',
    'me/documents/for/popup/{input_id}'             => 'ca-nhan-toi/tai-lieu/danh-cho/popup/{input_id}',

    'auth'                                          => 'xac-thuc',
    'auth/login'                                    => 'xac-thuc/dang-nhap',
    'auth/logout'                                   => 'xac-thuc/dang-xuat',
    'auth/register'                                 => 'xac-thuc/dang-ky',
    'auth/register/social'                          => 'xac-thuc/dang-ky/mang-xa-hoi',
    'auth/inactive'                                 => 'xac-thuc/chua-kich-hoat',
    'auth/activate'                                 => 'xac-thuc/kich-hoat',
    'auth/activate/{id}/{activation_code}'          => 'xac-thuc/kich-hoat/{id}/{activation_code}',
    'auth/social'                                   => 'xac-thuc/lien-ket',
    'auth/social/{provider}'                        => 'xac-thuc/lien-ket/{provider}',
    'auth/social/callback'                          => 'xac-thuc/lien-ket/kiem-tra',
    'auth/social/callback/{provider}'               => 'xac-thuc/lien-ket/kiem-tra/{provider}',
    'password'                                      => 'quen-mat-khau',
    'password/email'                                => 'quen-mat-khau/thu-dien-tu',
    'password/reset'                                => 'quen-mat-khau/thiet-lap-lai',
    'password/reset/{token}'                        => 'quen-mat-khau/thiet-lap-lai/{token}',

    'admin'                                         => 'quan-tri',
    'admin/my-documents'                            => 'quan-tri/tai-lieu-cua-toi',
    'admin/user-roles'                              => 'quan-tri/vai-tro-nguoi-dung',
    'admin/users'                                   => 'quan-tri/nguoi-dung',
    'admin/users/create'                            => 'quan-tri/nguoi-dung/them-moi',
    'admin/users/{id}'                              => 'quan-tri/nguoi-dung/{id}',
    'admin/users/{id}/edit'                         => 'quan-tri/nguoi-dung/{id}/chinh-sua',
    'admin/app-options'                             => 'quan-tri/thiet-lap',
    'admin/app-options/{id}'                        => 'quan-tri/thiet-lap/{id}',
    'admin/app-options/{id}/edit'                   => 'quan-tri/thiet-lap/{id}/chinh-sua',
    'admin/extensions'                              => 'quan-tri/tien-ich-mo-rong',
    'admin/extensions/{name}'                       => 'quan-tri/tien-ich-mo-rong/{name}',
    'admin/extensions/{name}/edit'                  => 'quan-tri/tien-ich-mo-rong/{name}/chinh-sua',
    'admin/widgets'                                 => 'quan-tri/cong-cu-hien-thi',
    'admin/widgets/{id}'                            => 'quan-tri/cong-cu-hien-thi/{id}',
    'admin/widgets/{id}/edit'                       => 'quan-tri/cong-cu-hien-thi/{id}/chinh-sua',
    'admin/ui-lang/php'                             => 'quan-tri/ngon-ngu-cho-giao-dien/tap-tin-php',
    'admin/ui-lang/email'                           => 'quan-tri/ngon-ngu-cho-giao-dien/mau-email',
    'admin/link-categories'                         => 'quan-tri/chuyen-muc-lien-ket',
    'admin/link-categories/create'                  => 'quan-tri/chuyen-muc-lien-ket/them-moi',
    'admin/link-categories/{id}'                    => 'quan-tri/chuyen-muc-lien-ket/{id}',
    'admin/link-categories/{id}/edit'               => 'quan-tri/chuyen-muc-lien-ket/{id}/chinh-sua',
    'admin/link-categories/{id}/sort'               => 'quan-tri/chuyen-muc-lien-ket/{id}/sap-xep',
    'admin/links'                                   => 'quan-tri/lien-ket',
    'admin/links/create'                            => 'quan-tri/lien-ket/them-moi',
    'admin/links/{id}'                              => 'quan-tri/lien-ket/{id}',
    'admin/links/{id}/edit'                         => 'quan-tri/lien-ket/{id}/chinh-sua',
    'admin/pages'                                   => 'quan-tri/chuyen-trang',
    'admin/pages/create'                            => 'quan-tri/chuyen-trang/them-moi',
    'admin/pages/{id}'                              => 'quan-tri/chuyen-trang/{id}',
    'admin/pages/{id}/edit'                         => 'quan-tri/chuyen-trang/{id}/chinh-sua',
    'admin/article-categories'                      => 'quan-tri/chuyen-muc-chuyen-de',
    'admin/article-categories/create'               => 'quan-tri/chuyen-muc-chuyen-de/them-moi',
    'admin/article-categories/{id}'                 => 'quan-tri/chuyen-muc-chuyen-de/{id}',
    'admin/article-categories/{id}/edit'            => 'quan-tri/chuyen-muc-chuyen-de/{id}/chinh-sua',
    'admin/articles'                                => 'quan-tri/chuyen-de',
    'admin/articles/create'                         => 'quan-tri/chuyen-de/them-moi',
    'admin/articles/{id}'                           => 'quan-tri/chuyen-de/{id}',
    'admin/articles/{id}/edit'                      => 'quan-tri/chuyen-de/{id}/chinh-sua',
    'admin/media-categories'                        => 'quan-tri/chuyen-muc-nghe-nhin',
    'admin/media-categories/create'                 => 'quan-tri/chuyen-muc-nghe-nhin/them-moi',
    'admin/media-categories/{id}'                   => 'quan-tri/chuyen-muc-nghe-nhin/{id}',
    'admin/media-categories/{id}/edit'              => 'quan-tri/chuyen-muc-nghe-nhin/{id}/chinh-sua',
    'admin/media-categories/{id}/sort'              => 'quan-tri/chuyen-muc-nghe-nhin/{id}/sap-xep',
    'admin/media-items'                             => 'quan-tri/nghe-nhin',
    'admin/media-items/create'                      => 'quan-tri/nghe-nhin/them-moi',
    'admin/media-items/{id}'                        => 'quan-tri/nghe-nhin/{id}',
    'admin/media-items/{id}/edit'                   => 'quan-tri/nghe-nhin/{id}/edit',
];