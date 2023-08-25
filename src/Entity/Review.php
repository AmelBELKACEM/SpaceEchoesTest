<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_collection_post"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups({"get_collection_post"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     * @Groups({"get_collection_post"})
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_collection_post"})
     */
    private $userReview;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="reviewsReported")
     */
    private $UsersReports;

    public function __construct()
    {
        $this->UsersReports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getUserReview(): ?User
    {
        return $this->userReview;
    }

    public function setUserReview(?User $userReview): self
    {
        $this->userReview = $userReview;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersReports(): Collection
    {
        return $this->UsersReports;
    }

    public function addUsersReport(User $usersReport): self
    {
        if (!$this->UsersReports->contains($usersReport)) {
            $this->UsersReports[] = $usersReport;
        }

        return $this;
    }

    public function removeUsersReport(User $usersReport): self
    {
        $this->UsersReports->removeElement($usersReport);

        return $this;
    }
}
